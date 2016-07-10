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
					'url' => 'usuario/filtrarUsuarios'
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
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Email</th>
					<th>Provicia</th>
					<th>Fecha Registro</th>
					<th>Premium</th>
				</thead>
				<tbody>
					@foreach($usuarios as $usuario)			 
						<tr>						    	
							<td class="table-text"><div>{{ $usuario->name }}</div></td>
							<td class="table-text"><div>{{ $usuario->apellido}}</div></td>
							<td class="table-text"><div>{{ $usuario->email }}</div></td>
							<td class="table-text"><div>{{ $usuario->provincia }}</div></td>
							<td class="table-text"><div>{{ $usuario->created_at }}</div></td>

							@if($usuario->premium == 1)
								<td class="table-text"><div><span class="glyphicon glyphicon-ok"></span></div></td>
							@else
								<td class="table-text"><div><span class="glyphicon glyphicon-remove"></span></div></td>
							@endIf
							<td>
		                        <div class= "pull-right">
				    				{!! Form::open([
		                                'method' => 'GET',
		                                'url' => ['usuario/seguimiento', $usuario->id]
		                            ]) !!}
		                            <button type="submit" class="btn btn-warning btn-xs">Seguimiento</button>	
		                            {!! Form::close() !!}                                              
			                    </div>
							</td>

						</tr>					    	
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
			<label>Total de Usuarios : {{count($usuarios)}}</label>
		</div>

	</div>
</div>
@stop
