@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('newMovie') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('movies.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="titulo" class="col-md-4 col-form-label text-md-right">{{ __('tittle') }}</label>

                            <div class="col-md-6">
                                <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ old('titulo') }}" required autocomplete="titulo" autofocus>

                                @error('titulo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="genero" class="col-md-4 col-form-label text-md-right">{{ __('gender') }}</label>

                            <div class="col-md-6">
                                <input id="genero" type="text" class="form-control @error('genero') is-invalid @enderror" name="genero" value="{{ old('genero') }}" required autocomplete="new-password">

                                @error('genero')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="duracion" class="col-md-4 col-form-label text-md-right">{{ __('duration') }}</label>

                            <div class="col-md-6">
                                <input id="duracion" type="text" class="form-control @error('duracion') is-invalid @enderror" name="duracion" value="{{ old('duracion') }}" required autocomplete="duracion">

                                @error('duracion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="resumen" class="col-md-4 col-form-label text-md-right">{{ __('resumen') }}</label>

                            <div class="col-md-6">
                                <input id="resumen" type="text" class="form-control" name="resumen" value="{{ old('resumen') }}" required autocomplete="resumen">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="director" class="col-md-4 col-form-label text-md-right">{{ __('director') }}</label>

                            <div class="col-md-6">
                                <input id="director" type="text" class="form-control @error('director') is-invalid @enderror" name="director" value="{{ old('director') }}" required autocomplete="director">

                                @error('director')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="urlubicacion" class="col-md-4 col-form-label text-md-right">{{ __('urlubication') }}</label>

                            <div class="col-md-6">
                                <input id="urlubicacion" type="text" class="form-control @error('urlubicacion') is-invalid @enderror" name="urlubicacion" value="{{ old('urlubicacion') }}" required autocomplete="urlubicacion">

                                @error('urlubicacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="clasificacion" class="col-md-4 col-form-label text-md-right">{{ __('clasification') }}</label>

                            <div class="col-md-6">
                            <select id="clasificacion" name="clasificacion" class="form-control  @error('clasificacion') is-invalid @enderror">
                                <option value="none">Seleccione la clasificación</option>
                                <option value="Todos" >Todos</option>
                                <option value="7+" >7+</option>
                                <option value="12+" >12+</option>
                                <option value="15+" >15+</option>
                                <option value="18+" >18+</option>
                            </select>
                                @error('clasificacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="anioestreno" class="col-md-4 col-form-label text-md-right">{{ __('anioEstren') }}</label>

                            <div class="col-md-6">
                                <input id="anioestreno" type="text" readonly="readonly" class="form-control datepickerYear @error('anioestreno') is-invalid @enderror" name="anioestreno" value="{{ old('anioestreno') }}" required autocomplete="off">

                                @error('anioestreno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('RegisterMovie') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @include('partials.session-status')
        </div>
    </div>
</div>
@endsection
