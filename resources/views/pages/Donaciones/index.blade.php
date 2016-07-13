@extends('layouts.app')

@section('content')
@include('pages.partials.alerts.js_confirm')  
<div class="container">
    
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1>Estadistica de usuarios</h1>
		</div>
		<br />
			@include('pages.partials.errors')                                         			
            @include('pages.partials.mensajes') 




		<div class="panel-body">
			{!!Form::open([
					'method' => 'GET',
					'url' => 'donacion/filtrarDonacion'
			])!!}			
			<table class="table table-striped task-table">
				<thead>					
					<th>				
						{!! Form::label('fIni', 'Fecha de Inicio:  ', ['class' => 'control-label ']) !!}                                  
						{!! Form::text('fIni',$filtros['fIni'] , ['class' => ' form-control inputFecha datepicker']) !!}
					</th>
					<th>
						<div class="pull-left"> 
						    <label class="label-control"> Fecha Fin:</label>
	                		{!! Form::text('fFin',$filtros['fFin'], ['class' => 'form-control inputFecha datepicker ']) !!}
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
				
					<th>Usuario</th>
					<th>Apellido</th>
					<th>Email</th>
					<th>Fecha</th>
					<th>Monto</th>
					
				</thead>
				<tbody>
					@foreach($donaciones as $donacion)			 
						<tr>						    	
							<td class="table-text"><div>{{ $donacion->name }}</div></td>
							<td class="table-text"><div>{{ $donacion->apellido}}</div></td>
							<td class="table-text"><div>{{ $donacion->email }}</div></td>
							<td class="table-text"><div>{{ $donacion->created_at }}</div></td>
							<td class="table-text"><div>{{ $donacion->monto }}</div></td>
						</tr>					    	
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
			<label>Total Donaciones : ${{$totalDonaciones}}</label>
		</div>

	</div>
</div>
@stop
