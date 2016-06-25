@extends('layouts.app')

@section('content')
@include('pages.partials.alerts.js_confirm')  
<div class="container">
    
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Mis Reservas</h2>
		</div>

		<div class="panel-body">		
			@include('pages.partials.errors') 
			@include('pages.partials.mensajes') 

			
			<table class="table table-striped task-table">
				
				<thead>
					
					<th>Titulo</th>
					<th>Fecha Inicio</th>
					<th>Fecha Fin</th>
					<th>Estado</th>				
				</thead>
				<tbody>
					@foreach($reservas as $reserva)			 
						<tr>	
					    	
					    	<td class="table-text"><div>{{ $reserva->titulo }}</div></td>
					    	<td class="table-text"><div>{{ $reserva->fechaIni }}</div></td>
					    	<td class="table-text"><div>{{ $reserva->fechaFin }}</div></td>
					    	<td class="table-text"><div>{{ $reserva->desc_estado }}</div></td>					    	
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