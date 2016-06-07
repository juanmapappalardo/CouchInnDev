@extends('layouts.app')

@section('content')
<div class="container">
    @include('pages.partials.alerts.js_confirm')  
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1>Tipos de Hospedaje</h1>
		</div>
		<br />
			@include('pages.partials.errors')                                         
            @include('pages.partials.mensajes') 


	    <div class= "pull-left" >
	    	{!! Form::open([
	        'method' => 'GET',
	        'route' => ['TiposDeHospedaje.create'],
	       	'class' => 'navbar-form navbar-left pull-left' 
	        ]) !!}

	        {!! Form::submit('Nuevo Tipo', ['class' => 'btn btn-primary btn-sm']) !!}
	        {!! Form::close() !!}           
	    </div> 


		<div class="panel-body">
			
			<table class="table table-striped task-table">
				<thead>
					<th>Descripcion</th>
				</thead>
				<tbody>
					@foreach($tipos as $tipo)			 
						<tr>	
					    	<td>
					    		<div class = "pull-left">
					    			{{ $tipo->descripcion }}
					    		</div>
					    	</td>
				    		<td>			
				    			<div class= "pull-right">
					    			{!! Form::open([
		                                'method' => 'GET',
		                                'route' => ['TiposDeHospedaje.edit', $tipo->id]                                
		                            ]) !!}

		                            <button type="submit" class="btn btn-primary btn-xs">Editar</button>
		                            {!! Form::close() !!}                                              
		                        </div>   	
		                        <div class= "pull-right">
							 			{!! Form::open([
			            				'method' => 'DELETE',
			            				'route' => ['TiposDeHospedaje.destroy', $tipo->id],
			            				'onsubmit' => 'return ConfirmDelete()'
			        				]) !!}

		                           	<button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
		                            {!! Form::close() !!}
			        			</div>
						    </td>
					    </tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>


@stop