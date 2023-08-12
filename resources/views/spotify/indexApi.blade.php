 {{-- {{ dump(session()->get('meData')) }} --}}
@extends('layouts.app')
@section('content-fluid')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <input type="hidden" id='hidden_token' value="{{ $token }}">
                @include('partials.session-status')
            </div>

        </div>
    </div>
    <div class="container-fluid fontContainerAlbum" style="padding: 20px;">
        @if (@isset($dataGeneros))
            <div style="
                display: flex;
                align-items: baseline;
                justify-content: space-between;">
                <h2 class="h2Albums">Categorias</h2>
                @if (session()->get('tokenSpotify') !== null)
                    @include('partials.infoMeSpotify')
                @endif

            </div>
            <div class=contentCategories>
                @foreach ($dataGeneros as $genero)
                    <div>
                        <div class="divIntALbum">
                            <a href="{{ route('spotify.categoriasbyId', $genero['id']) }}">
                                <img class="imgAlbum" src="{{ $genero['icons'][0]['url'] }}">
                                <div class="py-4">
                                    <div class="titleAlbum fontFIAlbum">
                                        <span>{{ $genero['name'] }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-12 col-lg-12 col-md-12" style="display: flex;justify-content: center;">
                {{ $dataGeneros->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection

