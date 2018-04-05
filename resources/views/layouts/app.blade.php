<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Minha Estante</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="{{asset('/W3.CSS/w3.css')}}">
    <link rel="stylesheet" href="{{asset('/W3.CSS/w3-theme-blue-grey.css')}}">
    <link rel="stylesheet" href="{{asset('/W3.CSS/css')}}">
    <link rel="stylesheet" href="{{asset('/W3.CSS/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="{{asset('/Croppie/croppie.css')}}">
    <script src="{{asset('/Croppie/croppie.js')}}"></script>
    <style>
    html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}

    img.img_perfil:hover {
        opacity: 0.5;
    }
    </style>
</head>
<body class="w3-theme-l5">
    <div id="app">
        <!-- Navbar -->
        <div class="w3-top">
         <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
          <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
          <a href="/home" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i><b>Rede</b>Social</a>


          @if (Auth::guest())
          <div class="w3-dropdown-hover w3-hide-small w3-right" style="margin-right: 20px">
            <button class="w3-button w3-padding-large" title="My Account">
                <img src="{{asset('/W3.CSS/avatar2.png')}}" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
                <span class="caret"></span>
            </button>
            <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                <a href="{{ route('login') }}" class="w3-bar-item w3-button">Login</a>
                <a href="{{ route('register') }}" class="w3-bar-item w3-button">Register</a>
            </div>
          </div>
          @else
          <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a>
          <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i></a>
          <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Messages"><i class="fa fa-envelope"></i></a>
          <div class="w3-dropdown-hover w3-hide-small">
            <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">3</span></button>
            <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
              <a href="#" class="w3-bar-item w3-button">One new friend request</a>
              <a href="#" class="w3-bar-item w3-button">John Doe posted on your wall</a>
              <a href="#" class="w3-bar-item w3-button">Jane likes your post</a>
            </div>
          </div>
          <div class="w3-dropdown-hover w3-hide-small w3-right">
            <button class="w3-button w3-padding-large" title="My Account">
                <img src="{{asset('/W3.CSS/avatar2.png')}}" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
                {{ Auth::user()->name }} <span class="caret"></span>
            </button>
            <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="w3-bar-item w3-button">Logout</a>
            </div>
          </div>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
          @endif
         </div>
        </div>

        <!-- Navbar on small screens -->
        <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
          <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
          <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
          <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
          <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
        </div>
        <!-- Page Container -->
        <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
            @yield('content')
        </div>
        <!-- /Page Container -->
        <br>

        <!-- Footer -->
        <div class="w3-bottom">
            <footer class="w3-container w3-theme-d5">
                <p class="w3-right">Powered by <a href="#" target="_blank">link</a></p>
            </footer>
        </div>
        <!-- /Footer -->
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
    // Accordion
    function myFunction(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
            x.previousElementSibling.className += " w3-theme-d1";
        } else {
            x.className = x.className.replace("w3-show", "");
            x.previousElementSibling.className =
            x.previousElementSibling.className.replace(" w3-theme-d1", "");
        }
    }

    // Used to toggle the menu on smaller screens when clicking on the menu button
    function openNav() {
        var x = document.getElementById("navDemo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
    </script>
</body>
</html>
