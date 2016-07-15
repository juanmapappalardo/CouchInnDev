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
								    	@if($reserva->id_estado == 2)
								    		
								    			{!! Form::open([
				        						'method' => 'GET',
				        						'route' => ['Reservas.edit', $reserva->id_reserva]
				        						]) !!}

										        {!! Form::submit('Editar Reserva', ['class' => 'btn btn-success btn-xs']) !!}
										        {!! Form::close() !!}           
								    		
								    	@endIf
									    	@if($reserva->concretada == 1)					    	
									    		@if(!$reserva->id_resenia)
							    	
							    			<button type="button" data-toggle="modal" data-target="#createModal{{$reserva->id_reserva}}" class="btn btn-success btn-xs">Comentar Experiencia</button>					    		
											<!-- Modal -->
											<div id="createModal{{$reserva->id_reserva}}" class="modal fade" role="dialog">
											  <div class="modal-dialog">

											    <!-- Modal content-->
											    <div class="modal-content">
											        <div class="modal-header">
	                                              		<button type="button" class="close" data-dismiss="modal">&times;</button>
	                                                     	<h4 class="modal-title">Comentar Experiencia</h4>
	                                                </div>
	                                                <div class="modal-body">
													 	{!! Form::open([
							                                'method' => 'POST',
							                                'url' => ['resenia/storeResenia']
							                            ]) !!}				
							                            
							                            {!! Form::hidden('id_reserva', $reserva->id_reserva) !!}		    
							                            {!! Form::hidden('id_usu_creador', Auth::user()->id) !!}
							                            <div class="form-group">
							                            	{!! Form::textarea('resenia', null, ['class' => 'form-control respuesta']) !!}
							                            </div>
							                            <div class=" pull-left">
							                            	{!! Form::label('puntaje', 'Puntaje:' ,['class' => 'control-label pull-left'])!!}
							                            </div>
							                          	<div class="form-group">
							                            		{{ Form::select('puntaje', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],0, ['class' => 'form-control selectxs']) }}
							                            </div>							                        
							                        </div>

							     					<div class="modal-footer">
	                                                	<button type="submit" class="btn btn-info btn-xs">Enviar</button>
	                                                	{!! Form::close() !!} 
	        											<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
	      											</div>
	      										</div>
	      									</div>						                                    
									@endIf
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