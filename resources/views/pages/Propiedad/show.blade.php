@extends('layouts.app')

@section('content')	
<div id="contenedor">
	<div class="row">
    	<div class="col-md-8 col-md-offset-2">	 
    		<div class="panel panel-default">
    			<div class="panel-heading">		    
			    	@include('pages.partials.errors') 
					@include('pages.partials.exito') 

		    		<div id="myCarousel" class="carousel slide" style="max-width: 900px; margin: 0 auto">
				      <ol class="carousel-indicators">
				        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				        <li data-target="#myCarousel" data-slide-to="1"></li>
				        <li data-target="#myCarousel" data-slide-to="2"></li>
				        <li data-target="#myCarousel" data-slide-to="3"></li>
				        <li data-target="#myCarousel" data-slide-to="4"></li>
				      </ol>
				      <!-- Carousel items --> 

				      <div class="carousel-inner">
				        <div class="active item">{!! Html::image('imagenes/couch/img_chania.jpg','',['width' => 460, 'height' => 345,'aling' => 'middle']) !!}</div>
				        <div class="item">{!! Html::image('imagenes/couch/img_chania.jpg','',['width' => 460, 'height' => 345,'aling' => 'middle']) !!}</div>
				        <div class="item">{!! Html::image('imagenes/couch/img_chania2.jpg','',['width' => 460, 'height' => 345,'aling' => 'middle']) !!}</div>
				        <div class="item">{!! Html::image('imagenes/couch/img_flower.jpg','',['width' => 460, 'height' => 345,'aling' => 'middle']) !!}</div>
				        <div class="item">{!! Html::image('imagenes/couch/img_flower2.jpg','',['width' => 460, 'height' => 345,'aling' => 'middle']) !!}</div>
				      </div>
				      <!-- Carousel nav -->

				      <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
				      <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
				    </div>
				</div>
				<div class="panel-body"> 
				    @foreach($hospedajes as $hospedaje)			 
					    <div class="form-group">
		                	<label><h4>Titulo: </h4></label> <label><h5><em>{{ $hospedaje->titulo }}</em></h5></label>
	                 	</div>
	                 	<div class="form-group">
		                	<label><h4>Usuario: </h4></label> <label><h5><em>{{ $hospedaje->name }}</em></h5></label>		                	
	                 	</div>
	                 	<div class="form-group">
		                	<label><h4>Provincia: </h4></label> <label><h5><em>{{ $hospedaje->descripcion  }}</em></h5></label>		                	
	                 	</div>
	                 	<div class="form-group">
		                	<label><h4>Tipo de Hospedaje:</h4> </label><label><h5><em>{{ $hospedaje->descTipoHosp  }}</em></h5></label>
	                 	</div>
	                 	<div class="form-group">
		                	<label><h4>Ciudad:</h4> </label><label><h5><em>{{ $hospedaje->descCiudad}}</em></h5></label>
	                 	</div>
	                 	<div class="form-group">
		                	<label><h4>Capacidad: </h4></label> <label><h5><em>{{ $hospedaje->capacidad }}</em></h5></label>		                	
	                 	</div>
	                 	<p class="large"></p>	
		                	<div class="form-group">
			                	<label><h4>Descripcion:</h4> </label>
		                 	</div>
		                 	<div class="form-group">
		                 	 	<h5>{{ $hospedaje->descripHosp }}</h5></p>		                	
		                 	</div>
		                <p class="large"></p>
		                <div class="pull-right">
		                	<a href="{{ route('Hospedaje.index') }}" class="btn btn-success btn-sm"></i>Volver</a>			
		                </div>
	                @endforeach

				</div>
			</div>
		</div>
	</div>
	
	
			   	
</div>
 
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('.myCarousel').carousel()
    });
</script>
@stop

