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

			{!!Form::open([
					'method' => 'GET',
					'url' => 'reserva/buscarCouchs'
			])!!}
			<table class="table table-striped task-table">
				<thead>					
					<th>				
						{!! Form::label('fechaInicio', 'Fecha de Inicio:  ', ['class' => 'control-label ']) !!}                                  
						{!! Form::text('fechaInicio',$fechaIniFiltro , ['class' => ' form-control inputFecha datepicker']) !!}
					</th>
					<th>
						<div class="pull-left"> 
						    <label class="label-control"> Fecha Fin:</label>
	                		{!! Form::text('fechaFin',$fechaFinFiltro, ['class' => 'form-control inputFecha datepicker ']) !!}
	                	</div>
                	</th>
                	<th>
						<button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
						{!! Form::close() !!}					    			

                	</th>
                </thead>
            </table>

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
		<div class="panel-footer">
			<label>Total de Couch's : {{count($couchs)}}</label>
		</div>
	</div>
</div>


@stop
