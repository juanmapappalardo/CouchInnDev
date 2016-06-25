@extends('layouts.app')

@section('content')
@include('pages.partials.alerts.js_confirm')  
<div class="container">
    
	<div class="panel panel-default">
		<div class="panel-heading">
			Reservas del hospedaje: {{ $titHosp }}
		</div>

		<div class="panel-body">		
			@include('pages.partials.errors') 
			@include('pages.partials.mensajes') 

			
			<table class="table table-striped task-table">
				
				<thead>
					
					<th>Usuario</th>
					<th>Fecha Inicio</th>
					<th>Fecha Fin</th>
					<th>Estado</th>				
				</thead>
				<tbody>
					@foreach($reservas as $reserva)			 
						<tr>	
					    	
					    	<td class="table-text"><div>{{ $reserva->name }}</div></td>
					    	<td class="table-text"><div>{{ $reserva->fechaIni }}</div></td>
					    	<td class="table-text"><div>{{ $reserva->fechaFin }}</div></td>
					    	<td class="table-text"><div>{{ $reserva->desc_estado }}</div></td>					    	
				    		
				    		<td>
				    			@if($reserva->id_estado == 2)
				    				<div class= "pull-right">					    			
						    			{!! Form::open([
				                                'method' => 'GET',
				                                'url' => ['reservas/confirmarReserva', $reserva->id_reserva], 		                               	
				                                'onsubmit' => 'return ConfirmAccion()'
				                            ]) !!}
					                    	<button type="submit" class="btn btn-success btn-xs">Confirmar</button>
					                   	{!! Form::close() !!}
									</div>					                   	
				            		<div class= "pull-right">					    							            		
					                	{!! Form::open([
				                                'method' => 'GET',
				                                'url' => ['reservas/cancelarReserva', $reserva->id_reserva], 		                               	
				                                'onsubmit' => 'return ConfirmAccion()'
				                            ]) !!}
					                    	<button type="submit" class="btn btn-danger btn-xs">Cancelar</button>
					                   	{!! Form::close() !!}
					                </div>
				                @endif


						    </td>
					    </tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>


@stop