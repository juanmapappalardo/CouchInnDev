@extends('layouts.app')

@section('content')
@include('pages.partials.alerts.js_confirm')  
<div class="container">
    
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>Seguimiento del Usuario:<i>{{$usuario->name}}</i></h2>
		</div>

		<div class="panel-body">		
					@include('pages.partials.errors') 
					@include('pages.partials.mensajes') 			
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
									<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Hospedajes</a>
									</h4>						
							</div>
							<div id="collapse1" class="panel-collapse collapse">
      							<div class="panel-body">
									<div class="panel panel-default">
										<br />
										<div class="panel-body">
											<table class="table table-striped task-table">
												<thead>
													<th>Titulo</th>
													<th>Provincia</th>
													<th>Capacidad</th>
													<th>Tipo</th>
													<th>Fecha Inicio</th>
													<th>Fecha Fin</th>
												</thead>
												<tbody>
													@foreach($hospedajes as $hospedaje)
														<tr>	
													    	<td>{{$hospedaje->titulo}}</td>
													    	<td>{{$hospedaje->provincia_nombre}}</td>
													    	<td>{{$hospedaje->capacidad}}</td>
													    	<td>{{$hospedaje->descripcion}}</td>
													    	<td>{{$hospedaje->fechaInicio}}</td>
													    	<td>{{$hospedaje->fechaFin}}</td>
													    </tr>
													@endforeach
												</tbody>
											</table>

										</div>
									</div>								
      							</div>
      						</div>	      					
						</div>
						<!-- COMENTARIOS -->	
						<div class="panel panel-default">
							<div class="panel-heading">
									<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Ver comentarios</a>
									</h4>
							</div>
							<div id="collapse2" class="panel-collapse collapse">
	  							<div class="panel-body">
	  								@foreach($comentarios as $coment)
				                 		<div class="comentario"> 
					                 		<h4><i>{{$coment->nomUsuario}}</i></h4>
					                 		<div class="pull-rigth">
					                 			<h6><i>{{$coment->created_at}}</i></h6>
					                 		</div>
					                 		<hr>
					                 		<div class="form-group">
						                		<label>
						                			<h5>{{ $coment->comentario }}</h5> 
						                		</label>
						                	</div>
						                </div>
						            @endforeach
	  							</div>
	  						</div>
						</div>
						<!--/COMENTARIOS-->
						<!--Resenias-->
						<div class="panel panel-default">
							<div class="panel-heading">
									<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Reseñas</a>
									</h4>
							</div>
							<div id="collapse3" class="panel-collapse collapse">
	  							<div class="panel-body">
  									@foreach($resenias as $resenia)	      									
			                 			<br />
				                 		<div class="comentario"> 
				                 			<h4><i>{{$resenia->name}}</i></h4>
					                 		<div class="pull-rigth">
				                 				<h6><i>{{$resenia->created_at}}</i></h6>
				                 			</div>
				                 			<hr>
				                 			<div class="form-group">
						                		<label>
						                			<h5>{{ $resenia->resenia }}</h5> 
						                		</label>								                										                		
						                	</div>
						                	<div class="form-group">								                		
						                		<label><i>Puntaje: {{$resenia->puntaje}}</i></label>
						                	</div>
				                 		</div>
				                 	@endforeach	  							
	  							</div>
	  						</div>
						</div>						
						<!--/Resenias-->
						<!--Reservas-->
						<div class="panel panel-default">
							<div class="panel-heading">
									<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Reservas</a>
									</h4>
							</div>
							<div id="collapse4" class="panel-collapse collapse">
	  							<div class="panel-body">
									<div class="panel panel-default">
										<br />
										<div class="panel-body">
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
													    	<td>{{$reserva->titulo}}</td>
													    	<td>{{$reserva->fechaIni}}</td>
													    	<td>{{$reserva->fechaFin}}</td>
													    	<td>{{$reserva->desc_estado}}</td>
													    </tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>								
	  							</div>
	  						</div>
						</div>												
						<!--/Reservas->
						<!--Puntajes-->
						<div class="panel panel-default">
							<div class="panel-heading">
									<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Puntajes</a>
									</h4>
							</div>
							<div id="collapse5" class="panel-collapse collapse">
	  							<div class="panel-body">
									<div class="panel panel-default">
										<br />
										<div class="panel-body">
											<table class="table table-striped task-table">
												<thead>
													<th>Titulo</th>
													<th>Fecha Inicio Reserv</th>
													<th>Fecha Fin Reserv</th>
													<th>Fecha Puntuación</th>													
													<th>Puntaje</th>

												</thead>
												<tbody>
													@foreach($puntajes['puntajes'] as $puntaje)
														<tr>	
													    	<td>{{$puntaje->titulo}}</td>
													    	<td>{{$puntaje->fechaIni}}</td>
													    	<td>{{$puntaje->fechaFin}}</td>
													    	<td>{{$puntaje->fechaPuntuacion}}</td>
													    	<td>{{$puntaje->puntaje}}</td>
													    </tr>
													@endforeach
												</tbody>
											</table>
										</div>
										<div class="panel-footer">
											<label>Total de Puntos : {{$puntajes['total']}}</label>
										</div>

									</div>									  							
	  							</div>
	  						</div>
						</div>												
					</div>
					<div class="pull-left"> 
						<a href="{{ url('usuarios/getUsuarios') }}" class="btn btn-success btn-sm">Volver</a>			    		
					</div>
				</div>
		</div>
</div>

@stop
