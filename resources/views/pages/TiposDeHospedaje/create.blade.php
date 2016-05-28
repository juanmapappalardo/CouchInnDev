@extends('layouts.app')

@section('content')

<div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                        <h1>Nuevo Tipo de Hospedaje</h1>                       
            </div>

            <div class="panel-body">                

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                        {{ Session::get('flash_message') }}
                    </div>
                @endif

                {!! Form::open([
                    'route' => 'TiposDeHospedaje.store'
                ]) !!}

                <div class="form-group">
                    {!! Form::label('descripcion', 'Descripcion:', ['class' => 'control-label']) !!}
                    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
                </div>
                <div class="pull-right">
                    <a href="{{ route('TiposDeHospedaje.index') }}" class="btn btn-danger"></i>Cancelar</a>
                </div>  

                {!! Form::submit('Crear Tipo de Hospedaje', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
</div>

@stop