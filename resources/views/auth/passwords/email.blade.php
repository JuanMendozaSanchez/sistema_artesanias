@extends('layouts.app')

@section('title','Restablecer contraseña')

@section('content')
<div class="container">
    <br>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-3">
            
        </div>
        <div class="col-md-7">
            <br>
            <h2 class="text-center">Ingresa el correo con el que fuiste registrado!</h2>
            <hr>
            <br>
            <div class="card">
                <div class="card-header">{{ __('Restablecer contraseña') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Dirección de correo') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Enviar link de restableciemiento de contraseña') }}
                                </button>
                                <a href="/" class="btn btn-danger">
                                    Regresar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
