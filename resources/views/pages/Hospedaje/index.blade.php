@extends('layouts.app')

@section('content')
@include('pages.partials.alerts.js_confirm')  
<div class="container">
    
	<div class="panel panel-default">
		<div class="panel-heading">
			@if($idUsuario != Auth::user()->id)
				<h2>Hospedajes</h2>
			@else
				<h2> Mis Hospedajes</h2>
			@endif
		</div>
		@if($idUsuario != Auth::user()->id)
			<div class="panel panel-default">			
				<div class="panel-body">										 
					{!!Form::open([
						'method' => 'GET',
						'url' => 'hospedaje/buscar'
					])!!}
					{{Form::hidden('eliminar_hosp', $eliminar_hosp)}}
					<table class="table table-striped task-table">
						<thead>					
							<th>
								<label>Ciudad</label>	
								{!! Form::select('id_ciudad',$ciudades, $filtros['id_ciudad'], ['class' => 'form-control styled-select ']) !!}
							</th>
							<th>
								<label>Provincia</label>	
								{!! Form::select('id_provincia',$provincias,  $filtros['id_provincia'], ['class' => 'form-control styled-select']) !!}							
							</th>
							<th>
								<label>Tipo de Hospedaje</label>	
								{!! Form::select('idTipoHosp',$tiposHosp, $filtros['idTipoHosp'], ['class' => 'form-control styled-select']) !!}							
							</th>
							<th>
								<label>Titulo</label>
								{!! Form::text('titulo', $filtros['titulo'], ['class' => ' form-control styled-select']) !!}
							</th>
							<th>	
								<button type="submit" class="btn btn-primary btn-sm">Buscar</button>
								{!! Form::close() !!}					    			
							</th>

						</thead>				
					</table>
				</div>			
			</div>
		@endif

		<div class="panel-body">		
			@include('pages.partials.errors') 
			@include('pages.partials.mensajes') 

			
			<table class="table table-striped task-table">
				
				<thead>
					
					<th>Titulo</th>
					@if($idUsuario != Auth::user()->id)
						<th>Usuario</th>
					@endIf
					<th>Tipo</th>
					<th>Capacidad</th>
					<th>Provincia</th>
					<th>Fecha Inicio</th>
					<th>Fecha Fin</th>
					@if($idUsuario == Auth::user()->id)
						<th>Activo</th>
					@endIf
				</thead>
				<tbody>
					@foreach($hospedajes as $hospedaje)			 
						<tr>					    	
					    	<td class="table-text"><div>{{ $hospedaje->titulo }}</div></td>
					    	@if($idUsuario != Auth::user()->id)
						    	<td class="table-text">
						    		<div>
								 		{!! Form::open([
				            				'method' => 'GET',
				            				'url' => ['usuario/verPerfilUsuario', $hospedaje->idUsuario],			            				  				
				            				'id' => $hospedaje->idUsuario
				        				]) !!}					        					                            
						    			 <a href="#" onclick="document.getElementById('{{$hospedaje->idUsuario}}').submit()">{{ $hospedaje->name }}</a> 
						    			 {!! Form::close() !!}
						    		</div>
						    	</td>
						    @endIf
					    	<td class="table-text"><div>{{ $hospedaje->descTipoHosp }}</div></td>
					    	<td class="table-text"><div>{{ $hospedaje->capacidad }}</div></td>
					    	<td class="table-text"><div>{{ $hospedaje->provincia_nombre }}</div></td>
					    	<td class="table-text"><div>{{ $hospedaje->fechaInicio}}</div></td>
					    	<td class="table-text"><div>{{ $hospedaje->fechaFin}}</div></td>					    	
					    	@if($idUsuario == Auth::user()->id)
								@if($hospedaje->activo)
									<td class="table-text"><div><span class="glyphicon glyphicon-ok"></span></div></td>
								@else
									<td class="table-text"><div><span class="glyphicon glyphicon-remove"></span></div></td>
								@endIf
							@endIf
					    	<td>
					    		@if(($idUsuario == -1) && ($eliminar_hosp == 0))
					    			@if($hospedaje->premium == 1)
					    					
			                				<button  class="btn btn-warning btn-xs" data-toggle="modal" data-target="#createModal{{$hospedaje->id}}">
			                					Ver Imagen
			                				</button>
			                				<div class="modal fade" id="createModal{{$hospedaje->id}}" role="dialog">
			            						<div class="modal-dialog">
			        								<!-- MODAL CONTENT-->
			                						<div class="modal-content">
			                    						<!-- MODAL HEADER-->
			                							<div class="modal-header">
			                    							<button type="button" class="close" data-dismiss="modal">&times;</button>
			                     								<h4 class="modal-title">Imagen del Hospedaje: <label><i><h5>{{$hospedaje->titulo}}</h5></i></label></h4>
			                							</div>
			                							<div class="modal-body">					    							    		
			                								@if($hospedaje->pathFoto)	
			                									{!! Html::image($hospedaje->pathFoto,'',['class' => 'img-rounded' , 'width' => 460, 'height' => 345,'aling' => 'middle']) !!}
			                								@else
			                									<label><i>Hospedaje sin imagen</i></label>
			                								@endif
			                							</div>
			                							<div class="modal-footer">

															<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
														</div>                                                							                                                					
													</div>
												</div>
											</div>											    	
										
							    	@endIf
							   	@endif
					    	</td>

					    	<td>
			                    <div class= "pull-right">
				    				{!! Form::open([
		                                'method' => 'GET',
		                                'route' => ['Hospedaje.show', $hospedaje->id], 
		                               	'id' => 'formVer'
		                            ]) !!}
		                            <button type="submit" class="btn btn-success btn-xs">Detalle</button>								                            
		                            {!! Form::close() !!}                                              											                            
		                        </div>

		                        @if($eliminar_hosp == 0)
									@if(($idUsuario == Auth::user()->id) && ($hospedaje->activo))		                  
				                        <div class= "pull-right">
						    				{!! Form::open([
				                                'method' => 'GET',
				                                'route' => ['Hospedaje.edit', $hospedaje->id]
				                            ]) !!}
				                            <button type="submit" class="btn btn-warning btn-xs">Editar</button>	
				                            {!! Form::close() !!}                                              
					                    </div>
					                    <div class= "pull-right">					    			
									 		{!! Form::open([
					            				'method' => 'DELETE',
					            				'route' => ['Hospedaje.destroy', $hospedaje->id],
					            				'onsubmit' => 'return ConfirmAccion()'			            				
					        				]) !!}
					        				<button type="submit" class="btn btn-danger btn-xs">Eliminar</button>

				                            {!! Form::close() !!}					    			
				                        </div>
				                        <div class= "pull-right">					    			
										 	{!! Form::open([
				                                'method' => 'GET',
				                                'url' => ['hospedaje/verReservas', $hospedaje->id], 		                               	
				                            ]) !!}
					        				<button type="submit" class="btn btn-primary btn-xs">Ver Reservas</button>
				                            {!! Form::close() !!}					    			
				                        </div>				                    	
									@else
										@if($idUsuario != Auth::user()->id)
					                    	<div class= "pull-right">
						                    	{!! Form::open([
					                                'method' => 'GET',
					                                'url' => ['reservas/crearId', $hospedaje->id], 		                               	
					                            ]) !!}
						                    	<button type="submit" class="btn btn-primary btn-xs">Reservar</button>
						                    	{!! Form::close() !!}
						                    </div>													                        
						                @endIf
				                    @endif			        			
				                @else 
				                	<div class= "pull-right">					    			
				                		@if($hospedaje->activo)
									 		{!! Form::open([
					            				'method' => 'GET',
					            				'url' => ['hospedaje/actDesc', $hospedaje->id, 0],
					            				'onsubmit' => 'return ConfirmAccion()'			            				
					        				]) !!}					        					                            
					        				<button type="submit" class="btn btn-info btn-xs">Desactivar</button>
					        				{!! Form::close() !!}					    			
				        				@else 
									 		{!! Form::open([
					            				'method' => 'GET',
					            				'url' => ['hospedaje/actDesc', $hospedaje->id, 1],
					            				'onsubmit' => 'return ConfirmAccion()'			            				
					        				]) !!}					        					                            
				        					<button type="submit" class="btn btn-warning btn-xs">Activar</button>					        								        					
				        				@endif
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