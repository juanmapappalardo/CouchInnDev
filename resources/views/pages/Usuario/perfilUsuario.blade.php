@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-8 col-md-offset-2">	 
			<div class="panel panel-default">
		        <div class="panel-heading">
		        	Pefil de Usuario: {{ $usuario->name }}   -  Puntaje: {{$puntos}}
		        </div>
		        
		     	<div class="panel-body">
		     		@include('pages.partials.errors') 
					@include('pages.partials.exito') 

	     		   	
			     	<div class="form-group">	
			     		<div class="col-md-4">
			     			{!! Form::label('Name', 'Nombre:', ['class' => 'col-md-4 control-label']) !!}
			     		</div>
			     		<div class="col-md-6">
			     			{!! Form::label('name', $usuario->name, ['class' => 'col-md-6 form-control']) !!}
			     		</div>
			     	</div>
			     	<div class="form-group">
			     		<div class="col-md-4">
			     			{!! Form::label('Apellido', 'Apellido:', ['class' => 'col-md-4 control-label']) !!}
			     		</div>
			     		<div class="col-md-6">
			     			{!! Form::label('apellido', $usuario->apellido, ['class' => 'col-md-6 form-control']) !!}
			     		</div>
			     	</div>

			     	<div class="form-group">
			     		<div class="col-md-4">	
			     			{!! Form::label('Provicia', 'Provincia:', ['class' => 'col-md-4 control-label']) !!}
			     		</div>
			     		<div class="col-md-6">
			     			{!! Form::label('provicia', $usuario->provincia, ['class' => 'col-md-6 form-control']) !!}
			     		</div>
			     	</div>

			     	<div class="form-group">
			     			<br />
					     	{!! Form::label('FechaNacimiento', 'Fecha de Nacimiento:', ['class' => 'col-md-4 control-label ']) !!} 			     		     		
					    <div class="col-md-6">
					     {!! Form::label('fechaNacimiento', $usuario->fechaNacimiento, ['class' => 'form-control datepicker']) !!}
					    </div>
					</div>

			     	<div class="form-group">
			         	<div class="pull-right">		     	
				     		<br />
				     		<br />
				     		@if(Auth::user()->id == 16)
				     			<a href="{{ url('hospedaje/eliminarHospAdmin') }}" class="btn btn-success btn-sm">Volver</a>			    		
				     		@else
								<a href="{{ route('Hospedaje.index') }}" class="btn btn-success btn-sm">Volver</a>			    		
							@endIf

						</div>
					</div>
					{!! Form::close() !!}							
				</div>	    		    	
			</div>
		</div>
	</div>
</div>
@stop