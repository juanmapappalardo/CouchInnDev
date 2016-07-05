@extends('layouts.app')

@section('content')	
<div id="contenedor">
	<div class="row">
    	<div class="col-md-8 col-md-offset-2">	 
    		<div class="panel panel-default">
    			<div class="panel-heading">		    
			    	@include('pages.partials.errors') 
					@include('pages.partials.exito') 
					@if(! empty($imagenes))
			    		<div id="myCarousel" class="carousel slide" style="max-width: 900px; margin: 0 auto">
					      <ol class="carousel-indicators">
					        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					        <li data-target="#myCarousel" data-slide-to="1"></li>
					        <li data-target="#myCarousel" data-slide-to="2"></li>			        
					      </ol>
					      <!-- Carousel items --> 

					      <div class="carousel-inner">
					      	<div class="active item">{!! Html::image(array_values($imagenes)[0]->pathFoto,'',['class' => 'img-rounded' , 'width' => 460, 'height' => 345,'aling' => 'middle']) !!} </div>
					 		@if(!empty(array_values($imagenes)[1]))     	
					   			<div class="item">{!! Html::image(array_values($imagenes)[1]->pathFoto,'',['class' => 'img-rounded','width' => 460, 'height' => 345,'aling' => 'middle']) !!}</div>
					   		@endif
					   		@if(!empty(array_values($imagenes)[2]))     	
					   			<div class="item">{!! Html::image(array_values($imagenes)[2]->pathFoto,'',['class' => 'img-rounded', 'width' => 460, 'height' => 345,'aling' => 'middle']) !!}</div>
					   		@endif
					      </div>
					      <!-- Carousel nav -->

					      <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
					      <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
					    </div>
					@else
						Detalle de Hospedaje
						
					@endif
				</div>
				<div class="panel-body"> 
				    @foreach($hospedajes as $hospedaje)			 
					    <div class="form-group">
		                	<label><h4>Titulo: </h4></label> <label><h5><em>{{ $hospedaje->titulo }}</em></h5></label>
	                 	</div>
	                 	<div class="form-group">
		                	<label><h4>Usuario: </h4></label> <label><h5><em>{{ $hospedaje->name }}</em></h5></label>		                	
	                 	</div>
	                 	<div class="form-group">
		                	<label><h4>Provincia: </h4></label> <label><h5><em>{{ $hospedaje->provincia_nombre  }}</em></h5></label>		                	
	                 	</div>
	                 	<div class="form-group">
		                	<label><h4>Tipo de Hospedaje:</h4> </label><label><h5><em>{{ $hospedaje->descTipoHosp  }}</em></h5></label>
	                 	</div>
	                 	<div class="form-group">
		                	<label><h4>Ciudad:</h4> </label><label><h5><em>{{ $hospedaje->ciudad_nombre}}</em></h5></label>
	                 	</div>
	                 	<div class="form-group">
		                	<label><h4>Capacidad: </h4></label> <label><h5><em>{{ $hospedaje->capacidad }}</em></h5></label>		                	
	                 	</div>
	                 	<div class="form-group">
	                 		<hr class="style-five" />
	                 	</div>
	                	<div class="form-group">
		                	<label><h4>Descripcion:</h4><h5>{{ $hospedaje->descripHosp }}</h5> </label>
	                 	</div>	                 	
		                <div class="form-group">
	                 		<hr class="style-five" />
	                 	</div>
	                 	
	                 	<!-- DEJA TU COMENTARIO -->
	                 	<div class="panel-group" id="accordion">
	                 		@if($hospedaje->id_usuario <> Auth::user()->id)
	  							<div class="panel panel-default">
	    							<div class="panel-heading">
	      								<h4 class="panel-title">
	        								<a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><i> Realizar comentario</i></a>
	      								</h4>
		    						</div>
	    							<div id="collapse1" class="panel-collapse collapse">
		      							<div class="panel-body">

					                 		{!! Form::open(['url' => 'comentario/postearComentario', 'method' => 'POST']) !!}

					                 		{{Form::hidden('id_hospedaje', $id_hospedaje)}} 
					                 		<div class="form-group">
						                        <div class="col-md-4 ">
						                            {!! Form::label('comentario', 'Cometario:', ['class' => 'control-label']) !!}                                  
						                        </div>
						                       <br />
						                    </div>
						                    <div class="form-group">
						                        <div class="col-md-4">
						                            {!! Form::textarea('comentario', null, ['class' => 'form-control coment']) !!}                        
						                        </div>
						                    </div>
										</div>
										<div class="form-group">
											<div style="padding-left:30px;">	
												{!! Form::submit('Comentar', ['class' => 'btn btn-info btn-sm']) !!}	     			
								    							    		
											</div>
										    {!! Form::close() !!}									
										</div>								
									</div>							
								</div>
							@endIf

	                 	
  							<div class="panel panel-default">
    							<div class="panel-heading">
      								<h4 class="panel-title">
        								<a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><i>Ver comentarios</i></a>
      								</h4>
	    						</div>
    							<div id="collapse2" class="panel-collapse collapse">
	      							<div class="panel-body">
	      								
				                 		@foreach($comentarios as $coment)

				                 			<br />
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
						                		
					                					<br />		
					                				@if($coment->id_respuesta == -1)		                								                								                										                
					                					@if($hospedaje->id_usuario == Auth::user()->id)						                			
							                				<div class= "glyphicon glyphicon-share-alt"></div>
							                				<a  data-toggle="modal" data-target="#createModal{{$coment->id}}">
							                					Responder
							                				</a>
							                				<div class="modal fade" id="createModal{{$coment->id}}" role="dialog">
                                        						<div class="modal-dialog">
                                    								<!-- MODAL CONTENT-->
                                            						<div class="modal-content">
                                                						<!-- MODAL HEADER-->
                                                							<div class="modal-header">
                                                    							<button type="button" class="close" data-dismiss="modal">&times;</button>
                                                     								<h4 class="modal-title">Respuesta</h4>
                                                							</div>
                                                							<div class="modal-body">
	                                                							{!! Form::open([
	                                                								'url' => 'comentario/sotreRespuesta', 
	                                                								'method' => 'POST'
	                                                							]) !!}
	                                                							{!! Form::hidden('id_comentario', $coment->id) !!}
	                                                							{!! Form::textarea('respuesta', null, ['class' => 'form-control respuesta ']) !!}	                                                						
                                                								
                                                							</div>
                                                							 <div class="modal-footer">
                                                							 	<button type="submit" class="btn btn-info btn-xs">Responder</button>
                                                							 	{!! Form::close() !!} 
        																		<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
      																		</div>                                                							                                                					
                                                					</div>
                                                				</div>
                                                			</div>
                                                		@endIf
                                                	@else
                                                		
                                                			<a  data-toggle="collapse" data-target="#collap{{$coment->id}}"><i>Ver Respuesta</i></a>
  															<div id="collap{{$coment->id}}" class="collapse">
  																{{$coment->respuesta}}  														  															
  														  	</div>                                                		
                                                	@endIf
                                                </div>							                			
							                		
						                 	</div>	                 							                 							                
				                 		@endforeach
				                 	</div>
			                	</div>
			                	<div class="panel panel-default">
    								<div class="panel-heading">
      									<h4 class="panel-title">
        									<a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><i>Experiencias de otros Usuarios</i></a>
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
			                </div>
			            
				            @if($hospedaje->id_usuario == Auth::user()->id)   
				            	<br>
				                <div class="pull-right">
				                	<a href="{{ url('hospedajes/misHospedajes') }}" class="btn btn-success btn-sm"></i>Volver</a>			
				                </div>
				            @else
		                 		<br>
				                <div class="pull-right">
				                	<a href="{{ route('Hospedaje.index') }}" class="btn btn-success btn-sm"></i>Volver</a>			
				                </div>
				            @endIf			           
	                @endforeach
				</div>
			</div>
		</div>
	</div>		   	
</div>
 
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('.myCarousel').carousel()
    });
</script>
@stop

