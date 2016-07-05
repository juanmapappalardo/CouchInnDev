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
					            @else     					            	
						            @if($reserva->concretada)		
					                	@if(!$reserva->puntuada) 
				                			<button type="button" data-toggle="modal" data-target="#createModal{{$reserva->id_reserva}}" class="btn btn-success btn-xs">Puntuar Usuario</button>					    		
											<!-- Modal -->
											<div id="createModal{{$reserva->id_reserva}}" class="modal fade" role="dialog">
											  <div class="modal-dialog">

												  	<!-- Modal content-->
												    <div class="modal-content">
												        <div class="modal-header">
		                                              		<button type="button" class="close" data-dismiss="modal">&times;</button>
		                                                     	<h4 class="modal-title">Puntuar Usuario</h4>
		                                                </div>
		                                                <div class="modal-body">
		                                            		{!! Form::open(['url' => 'puntaje/puntuarUsuario', 'method' => 'POST']) !!}
		                                            		{!! Form::hidden('id_reserva', $reserva->id_reserva) !!}
		                                            		{!! Form::hidden('id_usuario_creador', Auth::user()->id) !!}
		                                            		{!! Form::hidden('id_usuario', $reserva->id_usu) !!}

		                                         			<div class=" pull-left">
						                            			{!! Form::label('puntaje', 'Puntaje:' ,['class' => 'control-label pull-left'])!!}
						                            		</div>
						                          			<div class="form-group">
						                            			{{ Form::select('puntaje', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],0, ['class' => 'form-control selectxs']) }}
						                            		</div>							                        
		                                                </div>
                            							<div class="modal-footer">
                            							 	<button type="submit" class="btn btn-info btn-xs">Puntuar</button>
                            							 	{!! Form::close() !!} 
															<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
														</div>                                                							                                                					
						                			</div>
						                		</div>
						                	</div>
					                	@endif					            
					                @endif
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