@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nombreusuario" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="nombreusuario" type="text" class="form-control @error('nombreusuario') is-invalid @enderror" name="nombreusuario" value="{{ old('nombreusuario') }}" required autocomplete="nombreusuario" autofocus>

                                @error('nombreusuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contrasena" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="contrasena" type="password" class="form-control @error('contrasena') is-invalid @enderror" name="contrasena" required autocomplete="new-password">

                                @error('contrasena')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fechanacimiento" class="col-md-4 col-form-label text-md-right">{{ __('Birthdate') }}</label>

                            <div class="col-md-6">
                                <input id="fechanacimiento" type="text" readonly="readonly" class="form-control datepicker @error('fechanacimiento') is-invalid @enderror" name="fechanacimiento" value="{{ old('fechanacimiento') }}" required autocomplete="off">

                                @error('fechanacimiento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="paisresidencia" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                            <div class="col-md-6">
                                <input id="paisresidencia" type="text" class="form-control @error('paisresidencia') is-invalid @enderror" name="paisresidencia" value="{{ old('paisresidencia') }}" required autocomplete="paisresidencia">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tiposuscripcion" class="col-md-4 col-form-label text-md-right">{{ __('tipeSuscription') }}</label>

                            <div class="col-md-6">
                                <input id="tiposuscripcion" type="text" class="form-control @error('tiposuscripcion') is-invalid @enderror" name="tiposuscripcion" value="{{ old('tiposuscripcion') }}" required autocomplete="tiposuscripcion">

                                @error('tiposuscripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
