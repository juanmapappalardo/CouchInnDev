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

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">    

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

   
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}


    <!-- Styles -->
 

    <style>

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
            width: 330px; 
            min-width:330px; 
            max-width:330px; 

            height:350px; 
            min-height:350px; 
            max-height:350px; 
        }

        textarea.coment{
            width: 740px; 
            min-width:740px; 
            max-width:740px; 

            height:250px; 
            min-height:250px; 
            max-height:250px; 
        }

        textarea.respuesta{
            width: 568px; 
            min-width:568px; 
            max-width:568px; 

            height:250px; 
            min-height:250px; 
            max-height:250px; 
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
        .inputFecha{
            width:100px;
        }
        .calle{
            width:200px;
        }
        hr.conBorde{            
            border-top: 1px solid; 
            border-bottom: 1px solid ; 
            border-left:none; 
            border-right:none; 
            height: 2px; 
        }
       hr.style-five { 
            border: 0; 
            height: 1px; 
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));        
            position: sticky;
        }
        div.estatico{
            position:absolute;
        }
        .styled-select {
            height: 29px;
            overflow: hidden;
            width: 240px;
        }

        .comentario{

            background-color: #DCDCDC ;
            padding:0px 0px 0px 20px;
            border-radius: 25px;
            border: 1px solid #D3D3D3;
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
                    <img src="imagenes/logos/ImgCounchInn.png" class="img-circle" alt="CouchInn" width="30" height="23">
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
                    <!--
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
                    -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Hospedajes<span class="caret"></span>
                            </a>
                             <ul class="dropdown-menu" role="menu">
                                
                               
                                    <li>
                                        <a href="{{ route('Hospedaje.index') }}">Ver Hospedajes</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('Hospedaje.create') }}">Publicar Hospedaje</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('Reservas.index') }}">Ver mis Reservas</a>
                                    </li>
                                      <li>
                                        <a href="{{ url('hospedajes/misHospedajes') }}">Mis Hospedajes</a>
                                    </li>
                                @if(Auth::user()->administrador > 0)
                                    <li>
                                        <a href="{{ route('TiposDeHospedaje.index')}}">Tipos de Hospedaje</a>
                                    </li>
                                @endif
                            </ul>
                        </li>                        
                        @if(Auth::user()->administrador > 0)
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Estadisticas<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('reservas/couchRealizados') }}">Listar Couch's Relaizados</a>
                                    </li>
                                </ul>
                             </li>                        

                        @endif


                        <!--<li><a href="{{ route('Propiedad.index') }}">Mis Propiedades</a></li>-->

                        <!--<li><a href="{{ route('Hospedaje.create') }}">Alta Hospedaje</a></l>-->

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
    <!--<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">-->
    <!-- Latest compiled and minified CSS -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">-->
    <!-- Optional theme -->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">-->
    <!-- Latest compiled and minified JavaScript -->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>-->
    <!-- Jquery -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-standalone.css')}}">
    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
    <!-- Languaje -->
    <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
    <!--FIN IMPORTACIÓN DE COMPONENTES TIMEPICKER-->
    <!--IMPORTACIÓN DE COMPONENTES COLORPICKER-->
    <script src="{{ asset('bp-colorpicker/dist/js/bootstrap-colorpicker.js') }}"></script>    
    <link rel="stylesheet" href="{{ asset('bp-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <!--FIN IMPORTACIÓN DE COMPONENTES COLORPICKER-->


    @yield('scripts')

    <script>
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            language: "es",
            autoclose: true
        });
    </script>

</body>
</html>
