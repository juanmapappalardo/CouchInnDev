@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                             Nuevo Tipo de Hospedaje
                </div>
                <br />
                <div class="panel-body">                
                    @include('pages.partials.errors')                                         
                    @include('pages.partials.mensajes') 

                    {!! Form::open([
                        'route' => 'TiposDeHospedaje.store'
                    ]) !!}

                    <div class="form-group">
                        <div class="col-md-4">
                            {!! Form::label('descripcion', 'Descripcion:', ['class' => 'col-md-4 control-label']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::text('descripcion', null, ['class' => ' form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pull-right">                    
                            <br />            
                            <!--.glyphicon .glyphicon-ok   .glyphicon .glyphicon-arrow-left-->                          
                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary btn-sm']) !!}
                            <a href="{{ route('TiposDeHospedaje.index') }}" class="btn btn-success btn-sm">Volver</a>
                            {!! Form::close() !!}
                        </div>
                    </div>               
                </div>    
            </div>
        </div>
    </div>
</div>

@stop