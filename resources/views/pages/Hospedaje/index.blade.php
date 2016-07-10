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
					<table class="table table-striped task-table">
						<thead>					
							<th>
								<label>Ciudad</label>	
								{!! Form::select('id_ciudad',$ciudades, '-1', ['class' => 'form-control styled-select ']) !!}
							</th>
							<th>
								<label>Provincia</label>	
								{!! Form::select('id_provincia',$provincias, '-1', ['class' => 'form-control styled-select']) !!}							
							</th>
							<th>
								<label>Tipo de Hospedaje</label>	
								{!! Form::select('idTipoHosp',$tiposHosp, '-1', ['class' => 'form-control styled-select']) !!}							
							</th>
							<th>
								<label>Titulo</label>
								{!! Form::text('titulo', null, ['class' => ' form-control styled-select']) !!}
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
					<th>Usuario</th>
					<th>Tipo</th>
					<th>Capacidad</th>
					<th>Provincia</th>
					<th>Fecha Inicio</th>
					<th>Fecha Fin</th>
				</thead>
				<tbody>
					@foreach($hospedajes as $hospedaje)			 
						<tr>	
					    	
					    	<td class="table-text"><div>{{ $hospedaje->titulo }}</div></td>
					    	<td class="table-text"><div>{{ $hospedaje->name }}</div></td>
					    	<td class="table-text"><div>{{ $hospedaje->descTipoHosp }}</div></td>
					    	<td class="table-text"><div>{{ $hospedaje->capacidad }}</div></td>
					    	<td class="table-text"><div>{{ $hospedaje->provincia_nombre }}</div></td>
					    	<td class="table-text"><div>{{ $hospedaje->fechaInicio}}</div></td>
					    	<td class="table-text"><div>{{ $hospedaje->fechaFin}}</div></td>
					    	


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
									@if($idUsuario == Auth::user()->id)				                  
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
				                    	<div class= "pull-right">
					                    	{!! Form::open([
				                                'method' => 'GET',
				                                'url' => ['reservas/crearId', $hospedaje->id], 		                               	
				                            ]) !!}
					                    	<button type="submit" class="btn btn-primary btn-xs">Reservar</button>
					                    	{!! Form::close() !!}
					                    </div>
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