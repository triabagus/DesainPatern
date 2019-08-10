<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Title</title>
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .show-image-product{
            width:200px;
            height:200px;
            border-radius:50%;
        }

        .image-product{
            width:25px;
            height:25px;
            border-radius:10%;
        }

        .image-product-preview{
            width:50px;
            height:50px;
            border:2px solid #ccc;
            border-radius:20%;
        }
    </style>
</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                @if(session('cart'))
                                <i class="lnr lnr-cart"></i><span class="badge badge-pill badge-danger">{{ count(session('cart')) }}</span>
                                @else
                                <i class="lnr lnr-cart"></i><span class="badge badge-pill badge-danger">0</span>
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" style="min-width: 15rem;">
                                @if(session('cart'))
                                <?php $total = 0 ?>
                                @foreach(session('cart') as $id => $details)
                                    <?php $total += $details['price'] * $details['quantity'] ?>
                                @endforeach
                                
                                    @foreach(array_slice(session('cart'), -2, 2) as $id => $details)
                                        
                                        <div class="row cart-detail">
                                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                            <img src="{{ asset('image-product/'.$details['image'])}}" width="50" height="50" class="img-responsive ml-3"/>
                                            </div>
                                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                <span>{{ $details['name'] }} , {{ $details['quantity'] }}</span>
                                                <p class="price text-info"> Rp. {{ number_format($details['price'],2,',','.') }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                
                                <div class="col-lg-12">
                                    <p>Total : <span class="text-info">Rp. {{ number_format($total,2,',','.') }}</span></p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout pl-5 pr-5">
                                        <a href="{{ url('cart') }}" class="btn btn-primary btn-block">View all</a>
                                    </div>
                                </div>
                                @else
                                <div class="col-lg-12">
                                    <p>Anda belum membeli apapun</p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-12 text-center checkout pl-5 pr-5">
                                        <a href="{{ url('data-product') }}" class="btn btn-primary btn-block">Shopping</a>
                                    </div>
                                </div>
                                @endif
                                
                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>