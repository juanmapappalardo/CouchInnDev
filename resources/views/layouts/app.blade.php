<!DOCTYPE html>
<html lang="en">
<head>
<!--
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
      ../../imagenes/couch/
  }
  </style>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

-->


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CouchInn</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<!--
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">    

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
-->
    
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}


    <!-- Styles -->
    <script type="text/javascript">

        function justNumbers(e)
        {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
                return true;
            return /\d/.test(String.fromCharCode(keynum));
        }

        function validar(e) { // 1
            tecla = (document.all) ? e.keyCode : e.which; // 2
            if (tecla==8) return true; // 3
            patron =/[A-Za-z\s]/; // 4
            te = String.fromCharCode(tecla); // 5

            return patron.test(te); // 6
        }
    </script>

    <style>
    /*
        .carousel-indicators li {
            display: inline-block;
            width: 48px;
            height: 48px;
            margin: 10px;
            text-indent: 0;
            cursor: pointer;
            border: none;
            border-radius: 50%;
            background-color: #0000ff;
            box-shadow: inset 1px 1px 1px 1px rgba(0,0,0,0.5);    
        }
        .carousel-indicators .active {
            width: 48px;
            height: 48px;
            margin: 10px;
            background-color: #ffff99;
        }
    */

        textarea.style:focus, input.style:focus, input.style[type]:focus, .uneditable-input:focus {   
            0, 255, 0, 0.3
            border-color: rgba(0,150, 50, 0.8);
            box-shadow: 0 1px 1px rgba(0,150,50, 0.075) inset, 0 0 8px rgba(0,150, 50, 0.6) ;
            outline: 0 none;
            min-height:300px;  
            max-height:200px;
            
            max-width:800px; 
            min-width:800px;
            

        }
        textarea.fija{
            width: 200px; 
            min-width:200px; 
            max-width:200px; 

            height:200px; 
        }

        p.large {
            border: 1px solid #888888;         
            line-height: 60px;
        }
        .carousel-control.left, .carousel-control.right {
            background-image: none; 
            font-size: 100px; 
            margin-top: 150px;
            color: #99CC33;

        }


        .carousel-control .icon-prev, .carousel-control .icon-next {
            font-size: 100px; 
            margin-top: -50px;
            color: #f25;
            background-image: none;
        }

        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img {
            width: 70%;
            margin: auto;
            background-color:#000;
        }
    </style>

</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

           
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

           
                <a class="navbar-brand" href="{{ url('/') }}">
                    CouchInn
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Registrarse</a></li>
                    @else
                        <li><a href="{{ route('Hospedaje.index') }}">Hospedajes</a></li>

                        @if(Auth::user()->administrador > 0)
                            <li><a href="{{ route('TiposDeHospedaje.index')}}">Tipos de Hospedaje</a></li>
                        @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">

                                <li>
                                    <a href="{{ route('Usuario.edit', Auth::user()->id) }}">
                                        <span class="glyphicon glyphicon-user"></span>Ver Perfil
                                    </a>
                                </li>                                
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar Sesión</a></li>

                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <!--IMPORTACIÓN DE COMPONENTES TIMEPICKER-->
    <script src="https://www.google-analytics.com/analytics.js" async=""></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script src="{{ asset('jquery-timepicker/lib/site.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('jquery-timepicker/lib/site.css') }}">

    <script src="{{ asset('jquery-timepicker/lib/bootstrap-datepicker.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('jquery-timepicker/lib/bootstrap-datepicker.css') }}">

    <script src="{{ asset('jquery-timepicker/jquery.timepicker.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('jquery-timepicker/jquery.timepicker.css') }}">
    <!--FIN IMPORTACIÓN DE COMPONENTES TIMEPICKER-->
    <!--IMPORTACIÓN DE COMPONENTES COLORPICKER-->
    <script src="{{ asset('bp-colorpicker/dist/js/bootstrap-colorpicker.js') }}"></script>    
    <link rel="stylesheet" href="{{ asset('bp-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <!--FIN IMPORTACIÓN DE COMPONENTES COLORPICKER-->
    @yield('scripts')


</body>
</html>
