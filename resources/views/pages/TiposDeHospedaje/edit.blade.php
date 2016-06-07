@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	<div class="col-md-8 col-md-offset-2">	 
	 
			<div class="panel panel-default">
			     <div class="panel-heading">
			        <h1>Editar Tipo de Hospedaje</h1>                       
			     </div>
			    <div class="panel-body"> 
					@include('pages.partials.errors') 
					@include('pages.partials.exito') 

					{!! Form::model($tipo, [
					    'method' => 'PATCH',
					    'route' => ['TiposDeHospedaje.update', $tipo->id]
					]) !!}
					
					<div class="form-group">
						<div class="col-md-3 ">	
					    	{!! Form::label('descripcion', 'Descripcion:', ['class' => 'control-label']) !!}
					    </div>
					    <div class="col-md-5">
					    	{!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
						</div>
					</div>
					<br />
					<br />
					<div class="pull-right ">				
									    		
						<!--{!! Form::submit('Atualizar', ['class' => 'btn btn-primary ']) !!}-->				
                        	<button type="submit" class="btn btn-primary btn-sm">
                            	<span  class="glyphicon glyphicon-ok"></span>Actualizar
                            </button>
                          			
						
						<a href="{{ route('TiposDeHospedaje.index') }}" class="btn btn-danger btn-sm"></i>Cancelar</a>			
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop