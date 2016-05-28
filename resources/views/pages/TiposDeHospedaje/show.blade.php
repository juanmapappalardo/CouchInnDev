@extends('layouts.app')

@section('content')


<p class="lead">{{ $tipo->descripcion }}</p>
<hr>

<a href="{{ route('TiposDeHospedaje.index') }}" class="btn btn-info">Volver</a>
<a href="{{ route('TiposDeHospedaje.edit', $tipo->id) }}" class="btn btn-primary">Editar Tipo</a>

<div class="pull-right">
    <a href="#" class="btn btn-danger">Eliminar a un Tipo</a>
</div>

@stop