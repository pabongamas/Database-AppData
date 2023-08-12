@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('addMoviesUser') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('relusermovie.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="pelicula" class="col-md-4 col-form-label text-md-right">{{ __('movies') }}</label>

                            <div class="col-md-6">
                            <select id="pelicula" name="pelicula" class="form-control  @error('pelicula') is-invalid @enderror">
                                <option value="none">Seleccione la pelicula</option>
                                @foreach ($peliculas as $pel)
                                    <option value="{{ $pel->idpelicula }}">{{ $pel->titulo}}</option>
                                @endforeach
                            </select>
                                @error('pelicula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rate" class="col-md-4 col-form-label text-md-right">{{ __('rate') }}</label>

                            <div class="col-md-6">
                            <select id="rate" name="rate" class="form-control  @error('rate') is-invalid @enderror">
                                <option value="none">Seleccione la calificación</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>

                            </select>
                                @error('rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('addMovieUser') }}
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
