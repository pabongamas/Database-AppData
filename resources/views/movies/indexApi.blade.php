@extends('layouts.app')
@section('content-fluid')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('searchMovies') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('movies.searchApi') }}">
                        @csrf
                        <div class="form-row">
                         <div class="col-2 col-md-1 p-0">
                           <select class="form-control p-0"  name="tipo" autocomplete="titulo">
                                <option value="all">Todos</option>
                                <option value="movies">Peliculas</option>
                                <option value="series">Series</option>
                                <option value="episodes">Episodios</option>
                           </select>
                        </div>
                            <div class="col-8 col-md-10 p-0">
                                <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="@isset($titulo) {{ $titulo }}@endisset" required autocomplete="titulo" autofocus>
                            </div>
                            <div class="col-2 col-md-1 p-0">
                                <button type="submit" class="btn btn-primary searchApiMovie">
                                    {{ __('Buscar') }}
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
<div class="container-fluid" style="padding: 20px;">

        @if (@isset($data))
                <div class="row row-cols-1 row-cols-md-5">
                @foreach ($data as $d)
                <div class="col mb-3">
                <div class="card cursor-pointer" data-movie="{{ $d["imdbID"] }}">
                    <img src="{{ $d["Poster"] }}" class="card-img-top" alt="{{ $d["Title"] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $d["Title"] }}</h5>
                        <p class="card-text">{{ $d["Year"] }}</p>
                    </div>
                </div>
                </div>
                @endforeach
                </div>

        @endif
        @isset($data)
            @if(!empty($data))
                <div class="col-12 col-lg-12 col-md-12" style="display: flex;justify-content: center;">
                        {{ $data->appends(['titulo'=>$titulo])->links('pagination::bootstrap-4') }}
                    </div>
            @else
                <div class="alert alert-danger" role="alert">
                    {{$msj}}
                </div>
            @endif
        @endisset
</div>
@endsection
