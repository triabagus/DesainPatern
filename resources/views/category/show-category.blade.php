@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-11">
            <p><a href="/data-category" class="btn btn-danger">Back</a></p>
        </div>
        <div class="col-md-7 mt-3">
            <div class="card">

                <div class="card-header">
                    <h5>{{ $title }} {{ $category->id}}</h5>
                </div>

                <div class="card-body">
                    <div class="row" justify-content-center>
                        <div class="col-md-4 text-left">
                                <h3>{{ $category->name_categories }}</h3>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-header">Edit Category</div>

                <div class="card-body">
                    <form action="/category/update" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="name_categories">Name Category</label>
                            <input class="form-control" type="hidden" name="id" placeholder="id" value="{{ $category->id }}">
                            <input class="form-control" type="text" name="name_categories" placeholder="exp. Laptop" value="{{ $category->name_categories }}">
                            @error('name_categories')
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