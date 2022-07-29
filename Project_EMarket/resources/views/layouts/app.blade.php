<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.5/css/mdb.css" />

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>
    E-Market
  </title>


  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/Qty.js') }}" defer></script>

  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{asset('css/testing.css')}}" rel="stylesheet">
  {{-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> --}}
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Styles -->
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('jquery-ui.min.css')}}" />
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  


</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('EMarket', 'EMarket') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{route('showSmartPhone')}}">Smart Phone</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('showTablet')}}">Tablet</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('showLaptop')}}">Laptop/PC</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{route('showNewsList')}}">News</a>
            </li>
            <li class="nav-item">
              @php
              $count = null;
              if(session('cart')){
              $count = 0;
              foreach(session('cart') as $item)
              {
              $count += $item['quantity'];
              }

              }
              @endphp
              <a class="nav-link" href="{{route('showProductCart')}}"><i class="fa fa-shopping-cart fa-fw"></i>Cart
                <span class="badge badge-danger badge-counter">{{$count}}</span></a>
            </li>
            <li class="nav-item">

              <a class="nav-link" href="{{route('showwishlist')}}">WishList<span
                  class="badge badge-danger badge-counter"></a>
            </li>

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
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                @if(auth()->user()->role == '1')
                <a class="dropdown-item" href="{{route('showDashboard')}}">Dashboard</i></a>
                @endif
                @if(auth()->user()->role == '2')
                <a class="dropdown-item" href="{{route('profileShow')}}">MyAccount</i></a>
                @endif

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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

    <main>
      @yield('content')
    </main>


    @section('footer')
    <footer class="page-footer font-small blue-grey lighten-5">
      <div style="background-color: #efefef;">
        <div class="container">
          <div class="row py-4 d-flex align-items-center">
            <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
              <h6 class="mb-0 green-text">Get connected with us on social networks!</h6>
            </div>
            <div class="col-md-6 col-lg-7 text-center text-md-right">
              <a class="fb-ic">
                <i class="fab fa-facebook-f blue-text mr-4"></i>
              </a>
              <a class="tw-ic">
                <i class="fab fa-twitter blue-text mr-4"> </i>

              </a>
              <a class="gplus-ic">
                <i class="fab fa-google-plus-g red-text mr-4"></i>
              </a>
              <a class="li-ic">
                <i class="fab fa-linkedin-in pink-text mr-4"> </i>
              </a>
              <a class="ins-ic">
                <i class="fab fa-instagram blue-text"> </i>
              </a>
            </div>
          </div>
        </div>

        <div class="container text-center text-md-left mt-5">
          <div class="row mt-3 dark-grey-text">
            <div class="col-md-3 col-lg-4 col-xl-3 mb-4">
              <h6 class="text-uppercase font-weight-bold">About Us</h6>
              <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
              <p>Here you can use rows and columns to organize your footer content. Lorem ipsum dolor sit amet,
                consectetur
                adipisicing elit.</p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
              <h6 class="text-uppercase font-weight-bold">Products</h6>
              <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
              <p>
                <a class="dark-grey-text" href="{{route('showSmartPhone')}}">Smart Phone</a>
              </p>
              <p>
                <a class="dark-grey-text" href="{{route('showTablet')}}">Tablet</a>
              </p>
              <p>
                <a class="dark-grey-text" href="{{route('showLaptop')}}">Laptop/PC</a>
              </p>
            </div>

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
              <h6 class="text-uppercase font-weight-bold">Useful links</h6>
              <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
              <p>
                <a class="dark-grey-text" href="#!">Your Account</a>
              </p>
              <p>
                <a class="dark-grey-text" href="#!">Help</a>
              </p>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
              <h6 class="text-uppercase font-weight-bold">Contact</h6>
              <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
              <p>
                <i class="fa fa-home mr-3"></i> Yangon, Myanmar
              </p>
              <p>
                <i class="fa fa-envelope mr-3"></i> info@example.com
              </p>
              <p>
                <i class="fa fa-phone mr-3"></i> +95 9258456860
              </p>
              <p>
                <a class="dark-grey-text" href="{{route('contactUs')}}">Contact Us</a>
              </p>

            </div>

          </div>

        </div>

        <div class="footer-copyright text-center text-black-50 py-3">© 2018 Copyright:
        </div>
      </div>
    </footer>
  </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous" defer></script>
  <script src="{{asset('jquery-ui.min.js')}}" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.5/js/mdb.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  @yield('script')
  

</body>

</html>