@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Menu</div>
                <div class="card-body">
                    <a href="data-product" class="btn btn-primary">Data Product</a> 
                    <a href="data-category" class="btn btn-primary">Data Category</a> 
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are login
                    
                    @if(auth()->user()->is_admin == 0)
                    <a href="#">User</a>
                    @elseif(auth()->user()->is_admin == 1)
                    <a href="{{url('/admin')}}">Admin</a>
                    @else
                    <div class=”panel-heading”>Normal User</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
