@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Reserva
                </div>
                <br />
                <div class="panel-body">                
                    @include('pages.partials.errors')                                         
                    @include('pages.partials.mensajes')
                    {!!	Form::model($reserva, [
                        'method' => 'PATCH',
                        'route' => ['Reservas.update', $reserva->id_reserva] 
                    ]) !!}

                    {{Form::hidden('id_hospedaje', $reserva->id_hospedaje)}}
                    <div class="form-group">
                        {!! Form::label('fechaIni', 'Fecha de Inicio:', ['class' => 'col-md-4 control-label ']) !!}                                  
                        <div class="col-md-6">
                            {!! Form::text('fechaIni', $reserva->fechaIni, ['class' => 'form-control inputFecha datepicker ']) !!}
                        </div>
                    </div>                 
                    <div class="form-group">
                        {!! Form::label('fechaFin', 'Fecha de Fin:', ['class' => 'col-md-4 control-label ']) !!}                                  
                        <div class="col-md-6">
                            {!! Form::text('fechaFin', $reserva->fechaFin, ['class' => 'form-control inputFecha datepicker ']) !!}
                        </div>
                    </div>                   
  
                    <div class="form-group">
                        <div class="pull-right">                    
                            <br />            
                            <!--.glyphicon .glyphicon-ok   .glyphicon .glyphicon-arrow-left-->                          
                            {!! Form::submit('Actualizar', ['class' => 'btn btn-primary btn-sm']) !!}
                            <a href="{{ route('Reservas.index') }}" class="btn btn-success btn-sm">Volver</a>
                            {!! Form::close() !!}
                        </div>                    
                    </div>               
                </div>    
            </div>
        </div>
    </div>
</div>

@stop