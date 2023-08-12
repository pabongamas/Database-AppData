@extends('layouts.app')
@section('section-picture')
    <section>
        <div>
            @isset($album['tracks'])
                @if (session()->get('tokenSpotify') !== null)
                    <div class=" flexendSession"
                        style="padding-top: 15px;background-color: {{ HelperColor::colorPrimary($album['images']['1']['url']) }}">
                        @include('partials.infoMeSpotify')
                    </div>
                @endif
                <div class="fontImgAlbum flexEndAlign transAlbum"
                    style="background-color: {{ HelperColor::colorPrimary($album['images']['1']['url']) }}">
                    <div class="divInfoArtista">
                        <img class="boxShadowAlbum" style="width:100%" src="{{ $album['images']['1']['url'] }}">
                    </div>
                    <div style="padding-left: 0;" class="divInfoArtista">
                        <span>
                            <h5 class="nameArtistImg fontFIAlbum text-capitalize">{{ $album['type'] }}</h5>
                        </span>
                        <span>
                            <h1 class="nameArtistImg fontFIAlbum">{{ $album['name'] }}</h1>
                        </span>
                        <span classflexStartAlign>
                            @foreach ($album['artists'] as $artist)
                                <a class="hrefArtistaAlbum"
                                    href="{{ route('spotify.artistByID', $artist['id']) }}">{{ $artist['name'] }}</a>
                            @endforeach
                            <span style="font-weight: normal"
                                class="nameArtistImg fontFIAlbum typeTextAlbum ">{{ date('Y', strtotime($album['release_date'])) }}</span>
                            <span style="font-weight: normal"
                                class="nameArtistImg fontFIAlbum typeTextAlbum ">{{ $album['tracks']['total'] }}
                                canciones</span>
                        </span>

                    </div>
                </div>
            @endisset
        </div>
    </section>
@endsection
@section('content-fluid')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <input type="hidden" id='hidden_token' value="{{ $token }}">
                @include('partials.session-status')
            </div>

        </div>
    </div>
    <div class="container-fluid fontContainerAlbum transAlbum minHContAlbum"
        style="padding: 20px;background:linear-gradient(180deg,{{ HelperColor::colorPrimary($album['images']['1']['url']) }} -30%, #6b6868 50%)">
        @if (@isset($album['tracks']))
            <div class="">
                @php
                    $i = 0;
                @endphp
                <div class="contentTopTracksAlbumT">
                    <div class="flexStartAlign justifyCenter">#</div>
                    <div class="flexStartAlign">Titulo</div>
                    <div class="flexStartAlign"></div>
                    <div class="flexStartAlign justifyCenter">
                        <i class="far fa-clock"></i>
                    </div>
                </div>
                @foreach ($album['tracks']['items'] as $song)
                    @php
                        $i++;
                    @endphp
                    <div class="contentTopTracksAlbum">
                        <div class="flexStartAlign justifyCenter">{{ $i }}</div>
                        <div class="topTrack">
                            <span class="">{{ $song['name'] }}</span>
                        </div>
                        <div class="flexStartAlign justifyCenter">
                            <a data-toggle="tooltip" data-placement="top"
                                title="Reproducir {{ $song['name'] }} en Spotify" class="playsong"
                                href="{{ $song['external_urls']['spotify'] }}" target="_blank" rel="noopener noreferrer">
                                <i class="far fa-play-circle "></i>
                            </a>
                        </div>
                        <div class="flexStartAlign topTrackMin">
                            <span>{{ date('i:s', $song['duration_ms'] / 1000) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif
    </div>
@endsection
{{-- {{ dump($album) }} --}}
