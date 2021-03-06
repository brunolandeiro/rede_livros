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

    <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
    <!-- wysihtml5 parser rules -->

    <!-- Library -->
    <link rel="stylesheet" href="{{asset('/wysihtml5/examples/css/stylesheet.css')}}">
    <link rel="stylesheet" href="{{asset('/css/editor.css')}}">
    <link rel="stylesheet" href="{{asset('/css/meu.css')}}">
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
          <a href="/" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i><b>Minha</b>Estante</a>


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
                <img src="{{$img}}" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
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
        <!-- <div class="w3-bottom">
            <footer class="w3-container w3-theme-d5">
                <p class="w3-right">Powered by <a href="#" target="_blank">link</a></p>
            </footer>
        </div> -->
        <!-- /Footer -->
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>

    <!-- javascript -->
    <script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('/wysihtml5/parser_rules/advanced.js')}}"></script>
    <script src="{{asset('/wysihtml5/dist/wysihtml5-0.3.0.min.js')}}"></script>
    <script src="{{asset('/js/home.js')}}"></script>
    <!-- END javascript -->

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

    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            tags: true,
            placeholder: 'Comece a digitar o Título',
            allowClear: true,
            minimumInputLength: 3,
            ajax: {
                url: '/busca-livro',
                dataType: 'json',
                data: function (params) {
                    var query = {
                        search: params.term,
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: function (data) {
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data
                    }
                }
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            templateResult: formatRepo,
            templateSelection: formatRepoSelection

        });
    });
    function formatRepo (repo) {
      if (repo.loading) {
        return repo.text;
      }
      if(repo.img == null){
          repo.img = '/imgs_livro/book.jpg';
      }

      // var markup = "<div class='select2-result-repository clearfix'>" +
      //   "<div class='select2-result-repository__avatar '><img src='" + repo.img + "' height='60'/></div>" +
      //   "<div class='select2-result-repository__meta'>" +
      //     "<div class='select2-result-repository__title'>" + repo.text + "</div>";
      var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='w3-row'>" +
            "<div class='w3-col m2'>" +
                "<div class='select2-result-repository__avatar '><img src='" + repo.img + "' height='100'/></div>" +
            "</div>" +
            "<div class='w3-col m10'>" +
                "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title w3-margin'>" + repo.text + "</div>";
                "</div>" +
            "</div>" +
        "</div>" ;
      return markup;
    }

    function formatRepoSelection (repo) {
      return repo.full_name || repo.text;
    }
    </script>
    <script>
        var editor = new wysihtml5.Editor("wysihtml5-textarea", { // id of textarea element
            toolbar:      "wysihtml5-toolbar", // id of toolbar element
            parserRules:  wysihtml5ParserRules, // defined in parser rules set
            stylesheets: ["{{asset('css/editor.css')}}"]
        });
    </script>
</body>
</html>
