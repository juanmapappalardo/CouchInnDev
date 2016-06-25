@extends('layouts.app')

@section('content')
<div class="container">
    @include('pages.partials.alerts.js_confirm')  
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Mis Propiedades</h3>
		</div>
		<br />
		
	    <div class= "pull-left" >
	    	{!! Form::open([
	        'method' => 'GET',
	        'route' => ['Propiedad.create'],
	       	'class' => 'navbar-form navbar-left pull-left' 
	        ]) !!}

	        {!! Form::submit('Agregar Propiedad', ['class' => 'btn btn-primary btn-sm']) !!}
	        {!! Form::close() !!}           
	    </div> 
		

		<div class="panel-body">
			@include('pages.partials.errors') 
			@include('pages.partials.exito') 

			
			<table class="table table-striped task-table">
				<thead>
					<th>Provincia</th>
					<th>Ciudad</th>
					<th>Tipo</th>
					<th>Capacidad</th>
					
				</thead>
				<tbody>
					@foreach($propiedades as $propiedad)			 
						<tr>	
					    	
					    	<td class="table-text"><div>{{ $propiedad->provincia_nombre }}</div></td>
					    	<td class="table-text"><div>{{ $propiedad->ciudad_nombre }}</div></td>
					    	<td class="table-text"><div>{{ $propiedad->descripcion }}</div></td>	
					    	<td class="table-text"><div>{{ $propiedad->capacidad }}</div></td>				    	
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