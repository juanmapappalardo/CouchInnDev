@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                             Nuevo Reserva - Rango de fechas hospedaje: {{ $fechaIni}} - {{$fechaFin}}
                </div>
                <br />
                <div class="panel-body">                
                    @include('pages.partials.errors')                                         
                    @include('pages.partials.mensajes') 

                    {!! Form::open([
                        'method' => 'POST', 
                        'route' => 'Reservas.store'
                    ]) !!}
                    {{Form::hidden('id_hospedaje', $idHosp)}}
                    <div class="form-group">
                        {!! Form::label('fechaIni', 'Fecha de Inicio:', ['class' => 'col-md-4 control-label ']) !!}                                  
                        <div class="col-md-6">
                            {!! Form::text('fechaIni', null, ['class' => 'form-control inputFecha datepicker ']) !!}
                        </div>
                    </div>                 
                    <div class="form-group">
                        {!! Form::label('fechaFin', 'Fecha de Fin:', ['class' => 'col-md-4 control-label ']) !!}                                  
                        <div class="col-md-6">
                            {!! Form::text('fechaFin', null, ['class' => 'form-control inputFecha datepicker ']) !!}
                        </div>
                    </div>                   
  
                    <div class="form-group">
                        <div class="pull-right">                    
                            <br />            
                            <!--.glyphicon .glyphicon-ok   .glyphicon .glyphicon-arrow-left-->                          
                            {!! Form::submit('Reservar', ['class' => 'btn btn-primary btn-sm']) !!}
                            <a href="{{ route('Hospedaje.index') }}" class="btn btn-success btn-sm">Volver</a>
                            {!! Form::close() !!}
                        </div>
                    </div>               
                </div>    
            </div>
        </div>
    </div>
</div>

@stop