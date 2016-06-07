@extends('layouts.app')

@section('content')
<div class="container">
	@include('pages.partials.alerts.js_confirm')
    <div class="row">
    	<div class="col-md-8 col-md-offset-2">	 
			<div class="panel panel-default">
		        <div class="panel-heading">
		        	<h1>Donación del Usuario: {{ Auth::user()->name }} </h1><em> Se descontara $300 de su cuenta</em>
		        </div>
		        
		     	<div class="panel-body">
                 	@include('pages.partials.errors')                                         
                    @include('pages.partials.mensajes') 

					{!! Form::open(['url' => 'usuario/validarDonacion', 'method' => 'POST','onsubmit' => 'return ConfirmAccion()' ]) !!}			     	
					<div class="form-group">
			     		
			     			{!! Form::label('Tipo', 'Tipo de Tarjeta:', ['class' => 'col-md-4 control-label']) !!}
			     		
			     		<div class="col-md-6">
			     			{!! Form::text('tipoTarj', null, ['class' => 'col-md-6 form-control']) !!}
			     		</div>
			     	</div>

			     	<div class="form-group">
			     		<!--<div class="col-md-4">-->
			     			{!! Form::label('NroTarjeta', 'Nro Tarjeta:', ['class' => 'col-md-4 control-label']) !!}
			     		<!--</div>-->
			     		<div class="col-md-6">
			     			{!! Form::text('nroTarjeta', null, ['class' => 'col-md-6 form-control']) !!}
			     		</div>
			     	</div>

			     	<div class="form-group">

			     		<!--<div class="col-md-4">-->
			     			{!! Form::label('CodSeg', 'Cod. Seguridad:', ['class' => 'col-md-4 control-label']) !!}
			     		<!--</div>-->
			     		<div class="col-md-6">
			     			{!! Form::text('codSeg', null, ['class' => 'col-md-6 form-control']) !!}
			     		</div>
			     	</div>
			     	
			     	<div class="form-group">

			     		<!--<div class="col-md-4">-->
			     			{!! Form::label('FechVenc', 'Fecha de Vencimiento:', ['class' => 'col-md-4 control-label']) !!}
			     		<!--</div>-->
			     		<div class="col-md-6">
			     			{!! Form::text('fechVenc', null, ['class' => 'col-md-6 form-control']) !!}
			     		</div>
			     	</div>

			     	<div class="form-group">	
			     	
			     			{!! Form::label('nomTitular', 'Nombre Titular:', ['class' => 'col-md-4 control-label']) !!}
			     	
			     		<div class="col-md-6">
			     			{!! Form::text('nomTit', null, ['class' => 'form-control col-md-6' ]) !!}
			     		</div>
			     	</div>


			     	<div class="form-group">
				     	<div class="pull-right">		     		
				     		<br />		     		
							{!! Form::submit('Donar', ['class' => 'btn btn-primary btn-sm']) !!}	     			
					    	<a href="{{ url('/') }}" class="btn btn-danger btn-sm"></i>Cancelar</a>			    		
					    </div>
					</div>

					{!! Form::close() !!}							
				</div>	    		    	
			</div>
		</div>
	</div>
</div>
@stop
