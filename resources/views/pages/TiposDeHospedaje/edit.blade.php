@extends('layouts.app')

@section('content')
<div class="container">
	 
	 <div class="panel panel-default">
            <div class="panel-heading">
                        <h1>Editar Cliente</h1>                       
            </div>
     <div class="panel-body"> 
		@include('pages.partials.errors') 
		@include('pages.partials.exito') 

		{!! Form::model($tipo, [
		    'method' => 'PATCH',
		    'route' => ['TiposDeHospedaje.update', $tipo->id]
		]) !!}

		<div class="form-group">
		    {!! Form::label('descripcion', 'Descripcion:', ['class' => 'control-label']) !!}
		    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
		</div>
		<div class="pull-right">
    		<a href="{{ route('TiposDeHospedaje.index') }}" class="btn btn-danger"></i>Cancelar</a>
		</div>	
		{!! Form::submit('Atualizar', ['class' => 'btn btn-primary']) !!}

		{!! Form::close() !!}
	</div>
</div>

@stop