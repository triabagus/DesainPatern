@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-11">
            <p><a href="/data-product" class="btn btn-danger">Back</a></p>
        </div>
        <div class="col-md-7 mt-3">
            <div class="card">

                <div class="card-header">
                    <h5>{{ $title }} {{ $products->id}}</h5>
                </div>

                <div class="card-body">
                    <div class="row" justify-content-center>
                        <div class="col-md-6 text-center">
                            <img class="show-image-product" src="{{ asset('image-product/'.$products->image_product  )}}">
                        </div>
                        <div class="col-md-4 text-left">

                            <form method="post" action="/add-cart/{{ $products->name_product }}">
                                @method('put')
                                @csrf 
                                <h3>{{ $products->name_product }}</h3>
                                <p>Stock : {{ $products->stock }}</p>
                                <p><input name="id" class="form-control" type="hidden" value="{{ $products->id }}"></p>
                                <p><input name="quantity" class="form-control" type="number" min="1" max="{{ $products->stock }}" value="1"></p>
                                <p>Price : <span class="text-primary">{{ "Rp. ". number_format($products->price,2,',','.') }}</p>
                                <p>Categories : 
                                    <?php $data_id = $products->categories_id;?>
                                    @foreach($category as $c)
                                    <?php $data = $c->id; ?>
                                        @if($data_id == $data) {{ $c->name_categories }}@endif 
                                    @endforeach
                                </p>
                                <p><button type="submit" class="btn btn-success">Add to cart</button></p>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-header">Edit Product</div>

                <div class="card-body">
                    <form action="/product/update" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="name_product">Name Product</label>
                            <input class="form-control" type="hidden" name="id" placeholder="id" value="{{ $products->id }}">
                            <input class="form-control" type="text" name="name_product" placeholder="exp. Macbook Pro 2019" value="{{ $products->name_product }}">
                            @error('name_product')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input class="form-control" type="text" name="stock" placeholder="exp. 10" value="{{ $products->stock }}">
                            @error('stock')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input class="form-control" type="text" name="price" placeholder="exp. 100000" value="{{ $products->price }}">
                            @error('price')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="categories">Categories</label>
                            <select name="category" class="form-control">
                                <option value="">-- Select Category Product --</option>
                                <?php $data_id = $products->categories_id;?>
                                @foreach($category as $c)
                                <?php $data = $c->id; ?>
                                    <option value="{{ $c->id }}" @if($data_id == $data) selected @endif>{{ $c->name_categories }}</option>
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
                            
                            <p>
                                <img class="image-product-preview" src="{{ asset('image-product/'.$products->image_product  )}}"> 
                                <span>{{ $products->image_product }}</span>
                                <input type="hidden" name="hidden_image" value="{{ $products->image_product }}" >
                            </p>
                            @error('image_product')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                            <button class="btn btn-danger" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            
            </div>
        </div>

    </div>
</div>
@endsection