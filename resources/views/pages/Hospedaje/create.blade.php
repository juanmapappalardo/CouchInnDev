@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Nuevo Hospedaje
                </div>
            
                <div class="panel-body">                
                    @include('pages.partials.errors')                                         
                    @include('pages.partials.mensajes') 

                    {!! Form::open([
                        'route' => 'Hospedaje.store', 
                        'files' => true,
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                    
                    <div class="form-group">
                        <div class="col-md-4 control-label">
                            {!! Form::label('titulo', 'Titulo:', []) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::text('titulo', null, ['class' => ' form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 control-label">
                            {!! Form::label('provincia', 'Provincia:', []) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::select('id',$provincias, null, ['class' => ' form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('ciudad', 'Ciudad:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::select('id_ciudad',$ciudades, null, ['class' => ' form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('calle', 'Calle:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('calle', null, ['class' => 'form-control calle']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('nro', 'Nro:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('nro', null, ['class' => 'form-control inputFecha']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('capacidad', 'Capacidad:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::selectRange('capacidad',1, 30, ['class' => ' form-control']) !!}
                        </div>
                    </div>
                    


                    <div class="form-group">
                        {!! Form::label('tipoHospedaje', 'Tipo de Hospedaje:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::select('idTipoHospedaje',$tiposHosp, null, ['class' => ' form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">                      

                        {!! Form::label('fechaInicio', 'Fecha de Inicio:', ['class' => 'col-md-4 control-label ']) !!}                                  
                        <div class="col-md-6">
                            {!! Form::text('fechaInicio', \Carbon\Carbon::now()->format('d/m/Y'), ['class' => 'form-control inputFecha datepicker']) !!}

                             <style type="text/css">
                              input[name=fechaInicio] {
                                pointer-events: none;
                                tab-index: -1;
                               }
                             </style>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('fechaFin', 'Fecha de Fin:', ['class' => 'col-md-4 control-label ']) !!}                                  
                        <div class="col-md-6">
                            {!! Form::text('fechaFin', null, ['class' => 'form-control inputFecha datepicker ']) !!}
                        </div>
                    </div>                   
                    
                    <div class="form-group col-md-12">             
                        <hr />
                    </div>
                    

                    <div class="form-group">
                        <div class="col-md-4 ">

                            {!! Form::label('descripcion', 'Descripción:', ['class' => 'control-label']) !!}                                  
                        </div>
                        <div class="col-md-6">
                            {!! Form::textarea('descripcion', null, ['class' => 'form-control fija ']) !!}                        
                        </div>
                    </div>
                    <div class="form-group col-md-12"> 
                        <hr  />
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
                    <div class="form-group col-md-12"> <!-- control-label-->
                        <hr  />
                    </div>

                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="pull-right">                    
                                {!! Form::submit('Alta', ['class' => 'btn btn-primary btn-sm']) !!}
                                <a href="{{ url('/') }}" class="btn btn-success btn-sm">Cancelar</a>
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