@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header">
                    {{ $title }}
                    <a href="/product/pdf" class="btn btn-secondary float-right" target="_blank">PDF</a>
                    <a href="/product/export_excel" class="btn btn-success float-right mr-2" target="_blank">Export</a>
                    <button class="btn btn-primary float-right mr-2" type="button" data-toggle="modal" data-target="#importData">Import</button>
                </div>

                <div class="card-body">
                @if($errors->has('file'))
                    <div class="alert alert-danger alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{$errors->first('file')}}
                    </div> 
                @endif  
                
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

        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-header">Add Product</div>

                <div class="card-body">
                    <form action="/product/add" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name_product">Name Product</label>
                            <input class="form-control" type="text" name="name_product" placeholder="exp. Macbook Pro 2019">
                            @error('name_product')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input class="form-control" type="text" name="stock" placeholder="exp. 10">
                            @error('stock')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input class="form-control" type="text" name="price" placeholder="exp. 100000">
                            @error('price')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="categories">Categories</label>
                            <select name="category" class="form-control">
                                <option value="">-- Select Category Product --</option>
                                @foreach($category as $c)
                                    <option value="{{ $c->id }}">{{ $c->name_categories }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image_product">Image Product</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image_product" name="image_product">
                                    <label class="custom-file-label" for="image_product">Choose file</label>
                                </div>
                            </div>
                            @error('image_product')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-danger" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            
            </div>
        </div>

    </div>
</div>

<!-- Confirmation Delete -->
@foreach($products as $p)
<div id="confirmModal{{ $p->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span class="text-center">Are you sure you want to remove this data <b>{{ $p->name_product }}</b> ?</span>
            </div>
            <div class="modal-footer">
            <form action="/product/delete/{{ $p->id }}" method="post">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<div id="importData" class="modal fade" role="dialog">
    <div class="modal-dialog">

    <form action="/product/import_excel" method="post" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Data Product</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                @csrf
                <label for="excel">Pilih File Excel</label>
                <div class="form-group">
                    <input type="file" name="file" id="file" required="required">
                </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Import</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </form>

    </div>
</div>

@endsection
