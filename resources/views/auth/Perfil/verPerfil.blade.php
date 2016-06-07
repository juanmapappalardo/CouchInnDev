@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-8 col-md-offset-2">	 
			<div class="panel panel-default">
		        <div class="panel-heading">
		        	<h1>Pefil de Usuario: {{ $usuario->name }}</h1>
		        </div>
		        
		     	<div class="panel-body">
		     		@include('pages.partials.errors') 
					@include('pages.partials.exito') 

	     		   	{!! Form::model($usuario,[
			     		'method' => 'PATCH',
			     		'route' => ['Usuario.update', $usuario->id]
			     	]) !!}
			     	<div class="form-group">	
			     		<div class="col-md-4">
			     			{!! Form::label('name', 'Nombre:', ['class' => 'col-md-4 control-label']) !!}
			     		</div>
			     		<div class="col-md-6">
			     			{!! Form::text('name', null, ['class' => 'form-control col-md-6' ]) !!}
			     		</div>
			     	</div>
			     	<div class="form-group">
			     		<div class="col-md-4">
			     			{!! Form::label('Apellido', 'Apellido:', ['class' => 'col-md-4 control-label']) !!}
			     		</div>
			     		<div class="col-md-6">
			     			{!! Form::text('apellido', null, ['class' => 'col-md-6 form-control']) !!}
			     		</div>
			     	</div>



			     	<div class="form-group">
			     		<!--<div class="col-md-4">	-->

			     			{!! Form::label('fechaNacimiento', 'Fecha de Nacimiento:', ['class' => 'col-md-4 control-label']) !!} 
			     		<!--</div>-->
			     		<div class="col-md-6">
			     			{!! Form::text('fechaNacimiento', null, ['class' => 'col-md-6 form-control']) !!}
			     		</div>
			     	</div>
			     	<div class="form-group">
			     		<div class="col-md-4">	
			     			{!! Form::label('Provicia', 'Provincia:', ['class' => 'col-md-4 control-label']) !!}
			     		</div>
			     		<div class="col-md-6">
			     			{!! Form::text('provincia', null, ['class' => 'col-md-6 form-control']) !!}
			     		</div>
			     	</div>

			     	<div class="form-group">
			     		<div class="col-md-4">	
			     			{!! Form::label('Telefono', 'Telefono:', ['class' => 'col-md-4 control-label']) !!}
			     		</div>
			     		<div class="col-md-6">
			     			{!! Form::text('telefono', null, ['class' => 'col-md-6 form-control']) !!}
			     		</div>
			     	</div>

			     	
			     	<div class="form-group">
				     	<div class="pull-right">		     		
				     		<br />		     		
							{!! Form::submit('Atualizar', ['class' => 'btn btn-primary btn-sm']) !!}	     			
					    	<a href="{{ url('/') }}" class="btn btn-danger btn-sm"></i>Cancelar</a>			    		
					    </div>
				    	@if (Auth::user()->premium < 1)
					    	<div class = "pull-left">
					    		<br />
					    		<a href="{{ url('usuario/getViewDonacion') }}"><em><u>Cambiar a Usuario Premium </u></em></a>
					    	</div>
						@endIf	
					</div>
					{!! Form::close() !!}							
				</div>	    		    	
			</div>
		</div>
	</div>
</div>
@stop
