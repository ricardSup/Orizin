<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Orizin</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{asset('css/master.css')}}">
</head>
<body>
<div class="wrapper">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Orizin
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <!-- jika user adalah admin maka ditampilkan opsi manage game, manage user, manage transaction -->
                    @if (Auth::check() && Auth::user()->isAdmin())
                        <li><a href="{{ url('/product') }}">Manage Game</a></li>
                        <li><a href="{{ url('/user') }}">Manage User</a></li>
                        <li><a href="{{ url('/genre') }}">Manage Genre</a></li>
                        <li><a href="{{ url('/transaction') }}">Manage Transaction</a></li>
                    @endif
                    <!-- jika user telah login dan bukan admin maka ditampilkan opsi utk ke koleksi yang yang telah dibeli user login -->
                    @if (Auth::check() && !Auth::user()->isAdmin())
                        <li><a href="{{ url('/my-game') }}">My Games</a></li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- jika user telah login maka ditampilkan opsi utk cart -->
                    @if(Auth::check())
                        <li><a href="{{ url('/cart') }}"><span class="glyphicon glyphicon-shopping-cart"> Cart</span></a></li>
                    @endif
                    <!-- jika user guest(belum login) maka akan ditampilkan opsi untuk login dan register -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <!-- untuk menampilkan nama user yang sedang login -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Hi, {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    <div class="push"></div>
</div>
<div class="footer">
        <h4><p>© 2017 Orizin <br/> <span id="curr_date"></span></p></h4>
        <!-- logo facebook, twitter, google, dan mail source menggunakan font-awesome -->
        <span>
            <br />
            <a href="https://www.facebook.com/orizin"><i class="fa fa-facebook-square fa-3x social"></i></a>
            <a href="https://twitter.com/orizin"><i class="fa fa-twitter-square fa-3x social"></i></a>
            <a href="https://plus.google.com/orizin"><i class="fa fa-google-plus-square fa-3x social"></i></a>
            <a href="mailto:orizin@gmail.com"><i class="fa fa-envelope-square fa-3x social"></i></a>
        </span>
</div>
    <!-- JavaScripts -->
    <script src="{{asset('js/master.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
