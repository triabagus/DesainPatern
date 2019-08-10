@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header">
                    {{ $title }}
                    <!-- <a href="/category/pdf" class="btn btn-secondary float-right" target="_blank">PDF</a>
                    <a href="/category/export_excel" class="btn btn-success float-right mr-2" target="_blank">Export</a>
                    <button class="btn btn-primary float-right mr-2" type="button" data-toggle="modal" data-target="#importData">Import</button> -->
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
                            <th>Name Category</th>
                            <th class="text-center">Option</th>
                        </tr>
                        @foreach($category as $c)
                        <tr>
                            <td>{{ $c->name_categories }}</td>
                            <td class="text-center">
                                <a href="/category/show/{{ $c->id }}" class="btn btn-warning">Edit</a>  
                                <button type="button" data-toggle="modal" data-target="#confirmModal{{ $c->id }}" class="btn btn-danger">Delete</button> 
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {!! $category->links() !!}
                </div>
            
            </div>
        </div>

        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-header">Add Category</div>

                <div class="card-body">
                    <form action="/category/add" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name_categories">Name Category</label>
                            <input class="form-control" type="text" name="name_categories" placeholder="exp. Laptop">
                            @error('name_categories')
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
@foreach($category as $c)
<div id="confirmModal{{ $c->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span class="text-center">Are you sure you want to remove this data <b>{{ $c->name_categories }}</b> ?</span>
            </div>
            <div class="modal-footer">
            <form action="/category/delete/{{ $c->id }}" method="post">
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

    <form action="/category/import_excel" method="post" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Data Category</h4>
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
