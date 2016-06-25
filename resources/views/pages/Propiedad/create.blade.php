@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Nuevo Hospedaje
                </div>
                <br />
                <div class="panel-body">                
                    @include('pages.partials.errors')                                         
                    @include('pages.partials.mensajes') 

                    {!! Form::open([
                        'route' => 'Hospedaje.store'
                    ]) !!}

                    <div class="form-group">
                        
                            {!! Form::label('titulo', 'Titulo:', ['class' => 'col-md-4 control-label']) !!}
                        
                        <div class="col-md-6">
                            {!! Form::text('titulo', null, ['class' => ' form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">                      
                        {!! Form::label('fechaInicio', 'Fecha de Inicio:', ['class' => 'col-md-4 control-label ']) !!}                                  
                        <div class="col-md-6">
                            {!! Form::text('fechaInicio', null, ['class' => 'form-control inputFecha datepicker']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('fechaFin', 'Fecha de Fin:', ['class' => 'col-md-4 control-label ']) !!}                                  
                        <div class="col-md-6">
                            {!! Form::text('fechaFin', null, ['class' => 'form-control inputFecha datepicker ']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('img1', 'Imagen 1:', ['class' => 'col-md-4 control-label ']) !!}                                  
                        <div class="col-md-6">
                            {!! Form::file('img1', null, ['class' => 'form-control', 'type' => 'file']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('img2', 'Imagen 2:', ['class' => 'col-md-4 control-label ']) !!}                                  
                        <div class="col-md-6">
                            {!! Form::file('img2', null, ['class' => 'form-control', 'type' => 'file']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('img3', 'Imagen 3:', ['class' => 'col-md-4 control-label ']) !!}                                  
                        <div class="col-md-6">
                            {!! Form::file('img3', null, ['class' => 'form-control', 'type' => 'file']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripción:', ['class' => 'col-md-4 control-label']) !!}                                  
                        <div class="col-md-6">
                            {!! Form::textarea('descripcion', null, ['class' => 'form-control fija']) !!}
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="pull-right">                    
                                {!! Form::submit('Alta', ['class' => 'btn btn-primary btn-sm']) !!}
                                <a href="{{ route('TiposDeHospedaje.index') }}" class="btn btn-success btn-sm">Volver</a>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>

@stop