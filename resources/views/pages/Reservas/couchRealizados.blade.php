@extends('layouts.app')

@section('content')
@include('pages.partials.alerts.js_confirm')  
<div class="container">
    
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Couch's Realizados</h2>
		</div>

		<div class="panel-body">		
			@include('pages.partials.errors') 
			@include('pages.partials.mensajes') 

			
			<table class="table table-striped task-table">
				
				<thead>
					
					<th>Titulo Couch</th>
					<th>Fecha Inicio</th>
					<th>Fecha Fin</th>
					<th>Usuario Propietario</th>				
					<th>Usuario Inquilino</th>				
				</thead>
				<tbody>
					@foreach($couchs as $couch)			 
						<tr>	
					    	
					    	<td class="table-text"><div>{{ $couch->titulo }}</div></td>
					    	<td class="table-text"><div>{{ $couch->fechaIni }}</div></td>
					    	<td class="table-text"><div>{{ $couch->fechaFin }}</div></td>
					    	<td class="table-text"><div>{{ $couch->nameP }}</div></td>					    	
					    	<td class="table-text"><div>{{ $couch->nameI }}</div></td>
				    		<td>

						    </td>
					    </tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>


@stop
