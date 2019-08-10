@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    
                @if(session('success'))
                    <div class="alert alert-success alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{session('success')}}
                    </div> 
                @endif  

                    <table class="table table-hover">
                        <tr class="thead-dark">
                            <th>Name Product</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th class="text-center">Option</th>
                        </tr>
                        @foreach($products as $p)
                        <tr>
                            <td>{{ $p->name_product }} , {{ $p->categories_id }}</td>
                            <td>{{ $p->stock }}</td>
                            <td>{{ "Rp. ". number_format($p->price,2,',','.') }}</td>
                            <td><img class="image-product" src="{{ asset('image-product/'.$p->image_product  )}}"></td>
                            <td class="text-center">
                                <a href="/product/show/{{ $p->id }}" class="btn btn-warning">Edit</a>  
                                <button type="button" data-toggle="modal" data-target="#confirmModal{{ $p->id }}" class="btn btn-danger">Delete</button> 
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    {!! $products->links() !!}
                </div>
            
            </div>
        </div>

    </div>
</div>


@endsection
