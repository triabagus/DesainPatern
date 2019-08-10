@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-10 mt-3">
            <div class="card">

                <div class="card-body">
                    
                @if(session('success'))
                    <div class="alert alert-success alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{session('success')}}
                    </div> 
                @endif  
                
                    <table id="cart" class="table">
                        <thead class="table-dark">
                        <tr>
                            <th style="width:25%">Product</th>
                            <th style="width:15%">Price</th>
                            <th style="width:18%">Quantity</th>
                            <th style="width:22%" class="text-center">Subtotal</th>
                            <th style="width:20%">Option</th>
                        </tr>
                        </thead>
                        <?php $total = 0; ?> 
                        @if(session('cart'))                
                        @foreach(session('cart') as $id => $details)
                            <?php $total += $details['price'] * $details['quantity'] ?>
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col hidden-xs text-center"><img src="{{ asset('image-product/'.$details['image'])}}" width="70" height="70" class="img-responsive"/></div>
                                    <div class="col">
                                        <h4 class="nomargin">{{ $details['name'] }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Price">{{ "Rp. ". number_format($details['price'],2,',','.') }}</td>
                            <td data-th="Quantity"><input name="quantity" type="number" value="{{ $details['quantity'] }}" class="form-control quantity" /></td>
                            <td data-th="Subtotal">{{ "Rp. ". number_format($details['quantity'] * $details['price'],2,',','.') }}</td>
                            <td class="actions" data-th="">
                                <button data-id="{{ $id }}" class="btn btn-warning update-cart"><i class="lnr lnr-sync"></i></button>  
                                <button type="button" data-toggle="modal" data-target="#confirmModal{{ $id }}" class="btn btn-danger"><i class="lnr lnr-trash"></i></button> 
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Anda belum membeli apapun.</td>
                            </tr>
                        @endif
                    </table>
                    <div class="rows">
                        <div class="col-md-12 "> 
                            <p class="mr-5">
                            @if(session('cart'))
                                <a href="data-product" class="btn btn-success text-left">Shopping</a>
                                <a href="#" class="btn btn-primary text-left">Bayar</a>
                                <span class="text-right"><b>Total : </b>{{ "Rp. ". number_format($total,2,',','.') }}</span>
                            @else
                                <a href="data-product" class="btn btn-success text-left">Shopping</a>
                            @endif
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Confirmation Delete -->
@if(session('cart'))                     
@foreach(session('cart') as $id => $details)
<div id="confirmModal{{ $id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation Cart Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span class="text-center">Are you sure you want to remove this data <b>{{ $details['name'] }}</b> ?</span>
            </div>
            <div class="modal-footer">
                <button type="button" data-id="{{ $id }}" class="btn btn-danger remove-from-cart">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif

@endsection
@push('scripts')
    <script type="text/javascript">

        $(".update-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ url('update-cart') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}',id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
                success: function (response) {
                    window.location.reload();
                }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
                $.ajax({
                    url: '{{ url('delete-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
        });
    </script> 
@endpush
