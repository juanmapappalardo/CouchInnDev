@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">Recuperar Clave</div>
                <div class="panel-body">
                    @include('pages.partials.errors') 
                    
                    
                    @include('pages.partials.mensajes') 

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {!! Form::open(['url' => 'usuario/enviarLink', 'method' => 'GET' ]) !!}
                    <!--<form class="form-horizontal" role="form" method="POST" action="{{ url('/Usuario/enviarLink') }}"> -->
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Dirección de Email</label>

                            <div class="col-md-6">
                                <!--<input type="email" class="form-control" name="email" value="{{ old('email') }}">-->
                                {!! Form::text('email', null, ['class' => 'form-control col-md-6' ]) !!}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                            <br />
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i>Enviar Link
                                </button>
                            </div>
                        </div>
                        {!!Form::close()!!}
                    <!--</form>-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
