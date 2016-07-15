@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Editar Hospedaje
                </div>
            
                <div class="panel-body">                
                    @include('pages.partials.errors')                                         
                    @include('pages.partials.mensajes') 

                    {!! Form::model($hospedaje, [
                        'method' => 'PATCH',
                        'route' => ['Hospedaje.update', $hospedaje[0]->id], 
                        'files' => true,
                        'enctype' => 'multipart/form-data'

                    ]) !!}

                    <div class="form-group">
                        <div class="col-md-4 control-label">
                            {!! Form::label('titulo', 'Titulo:', []) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::text('titulo', $hospedaje[0]->titulo, ['class' => ' form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 control-label">
                            {!! Form::label('provincia', 'Provincia:', []) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::select('id',$provincias, $hospedaje[0]->idProvincia, ['class' => ' form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('ciudad', 'Ciudad:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::select('id_ciudad',$ciudades, $hospedaje[0]->idCiudad, ['class' => ' form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('calle', 'Calle:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('calle', $hospedaje[0]->calle, ['class' => 'form-control calle']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('nro', 'Nro:', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('nro', $hospedaje[0]->nro, ['class' => 'form-control inputFecha']) !!}
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
                            {!! Form::select('idTipoHospedaje',$tiposHosp, $hospedaje[0]->descTipoHosp, ['class' => ' form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">                      

                        {!! Form::label('fechaInicio', 'Fecha de Inicio:', ['class' => 'col-md-4 control-label ']) !!}                                  
                        <div class="col-md-6">
                            {!! Form::text('fechaInicio',\Carbon\Carbon::createFromFormat('Y-m-d', $hospedaje[0]->fechaInicio)->format('d/m/Y'), ['class' => 'form-control inputFecha datepicker']) !!}

                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('fechaFin', 'Fecha de Fin:', ['class' => 'col-md-4 control-label ']) !!}                                  
                        <div class="col-md-6">
                            {!! Form::text('fechaFin',\Carbon\Carbon::createFromFormat('Y-m-d', $hospedaje[0]->fechaFin)->format('d/m/Y') ,['class' => 'form-control inputFecha datepicker ']) !!}
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
                            {!! Form::textarea('descripcion',$hospedaje[0]->descripHosp, ['class' => 'form-control fija ']) !!}                        
                        </div>
                    </div>
                    <div class="form-group col-md-12"> 
                        <hr  />
                    </div>

                    @if($imagenes)                 
                        @if($sizeImgArray == 1)
                            <div class="form-group">                                            
                                <div class="pull-left col-md-4 control-label">
                                    Eliminar{!!Form::checkbox('deleteImg1', $imagenes[0]->id, false)!!}
                                </div>                                
                                <div class="col-md-6">                            
                                    {!! Html::image($imagenes[0]->pathFoto,'',['width' => 460, 'height' => 345,'aling' => 'middle']) !!}                                 
                                    <hr />
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
                        @else
                            @if($sizeImgArray == 2)
                                <div class="form-group">                                            
                                    <div class="pull-left col-md-4 control-label">
                                        Eliminar {!!Form::checkbox('deleteImg1', $imagenes[0]->id, false)!!}
                                    </div>                                
                                    <div class="col-md-6">                            
                                        {!! Html::image($imagenes[0]->pathFoto,'',['width' => 460, 'height' => 345,'aling' => 'middle']) !!}                                 
                                        <hr />
                                    </div>
                                </div>
                                <div class="form-group">                                            
                                    <div class="pull-left col-md-4 control-label">
                                       Eliminar {!!Form::checkbox('deleteImg2', $imagenes[1]->id, false)!!}
                                    </div>                                
                                    <div class="col-md-6">                            
                                        {!! Html::image($imagenes[1]->pathFoto,'',['width' => 460, 'height' => 345,'aling' => 'middle']) !!}                                 
                                        <hr />
                                    </div>
                                </div>
                                    <div class="form-group">
                                        {!! Form::label('img3', 'Imagen 3:', ['class' => 'col-md-4 control-label ']) !!}                                  
                                    <div class="col-md-6">
                                        {!! Form::file('img3', null, ['class' => 'form-control', 'type' => 'file']) !!}
                                    </div>
                                </div>
                            @else 

                                    <div class="form-group">                                            
                                        <div class="pull-left col-md-4 control-label">
                                            Eliminar {!!Form::checkbox('deleteImg1', $imagenes[0]->id, false)!!}
                                        </div>                                
                                        <div class="col-md-6">                            
                                            {!! Html::image($imagenes[0]->pathFoto,'',['width' => 460, 'height' => 345,'aling' => 'middle']) !!}                                 
                                            <hr />
                                        </div>
                                    </div>
                                    <div class="form-group">                                            
                                        <div class="pull-left col-md-4 control-label">
                                           Eliminar {!!Form::checkbox('deleteImg2', $imagenes[1]->id, false)!!}
                                        </div>                                
                                        <div class="col-md-6">                            
                                            {!! Html::image($imagenes[1]->pathFoto,'',['width' => 460, 'height' => 345,'aling' => 'middle']) !!}                                 
                                            <hr />
                                        </div>
                                    </div>
                                    <div class="form-group">                                            
                                        <div class="pull-left col-md-4 control-label">
                                            Eliminar {!!Form::checkbox('deleteImg3', $imagenes[2]->id, false)!!}
                                        </div>                                
                                        <div class="col-md-6">                            
                                            {!! Html::image($imagenes[2]->pathFoto,'',['width' => 460, 'height' => 345,'aling' => 'middle']) !!}                                 
                                            <hr />
                                        </div>
                                    </div>
                            @endif
                        @endif                     
                    @else
                   
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

                    @endIf
                    <div class="form-group col-md-12"> <!-- control-label-->
                        <hr  />
                    </div>

                    
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="pull-right">                    
                                {!! Form::submit('Actualizar', ['class' => 'btn btn-primary btn-sm']) !!}
                                <a href="{{ url('hospedajes/misHospedajes') }}" class="btn btn-success btn-sm">Volver</a>
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