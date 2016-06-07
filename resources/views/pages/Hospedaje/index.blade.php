@extends('layouts.app')

@section('content')
<div class="container">
    @include('pages.partials.alerts.js_confirm')  
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1>Hospedajes</h1>
		</div>
		<br />
		<!--
	    <div class= "pull-left" >
	    	{!! Form::open([
	        'method' => 'GET',
	        'route' => ['TiposDeHospedaje.create'],
	       	'class' => 'navbar-form navbar-left pull-left' 
	        ]) !!}

	        {!! Form::submit('Nuevo Tipo', ['class' => 'btn btn-primary btn-sm']) !!}
	        {!! Form::close() !!}           
	    </div> 
		-->

		<div class="panel-body">
			@include('pages.partials.errors') 
			@include('pages.partials.exito') 

			
			<table class="table table-striped task-table">
				<thead>
					<th>Titulo</th>
					<th>Usuario</th>
					<th>Tipo</th>
					<th>Capacidad</th>
					<th>Provincia</th>
				</thead>
				<tbody>
					@foreach($hospedajes as $hospedaje)			 
						<tr>	
					    	
					    	<td class="table-text"><div>{{ $hospedaje->titulo }}</div></td>
					    	<td class="table-text"><div>{{ $hospedaje->name }}</div></td>
					    	<td class="table-text"><div>{{ $hospedaje->descTipoHosp }}</div></td>
					    	<td class="table-text"><div>{{ $hospedaje->capacidad }}</div></td>
					    	<td class="table-text"><div>{{  $hospedaje->descripcion }}</div></td>

				    		<td>			
				    			<div class= "pull-right">
					    			
					    			<a href="{{ route('Hospedaje.show', $hospedaje->id) }}" class="btn btn-primary btn-sm">Detalle</a>
		                            {!! Form::close() !!}                                              
		                        <div>
						    </td>
					    </tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>


@stop