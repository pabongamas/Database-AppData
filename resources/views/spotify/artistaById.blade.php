@extends('layouts.app')
@section('section-picture')
    <section>
        <div>
            @isset($artist['images']['0'])
                @if (session()->get('tokenSpotify') !== null)
                    <div class=" flexendSession"
                        style="padding-top: 15px;padding-bottom: 15px;">
                        @include('partials.infoMeSpotify')
                    </div>
                @endif
                
                <div class="fontImgArtist flexEndAlign" style="background-image: url({{ $artist['images']['0']['url'] }})">
                    <div class="divInfoArtista">
                        <span>
                            <h1 class="nameArtistImg fontFIAlbum">{{ $artist['name'] }}</h1>
                        </span>
                        <span class="spanOyentes fontFIAlbum">{{ number_format($artist['followers']['total'],0,".",".") }} oyentes
                            mensuales</span>
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
    <div class="container-fluid fontContainerAlbum"
        style="padding: 20px;">
        @if (@isset($topTracks['tracks']))
            <div class="">
                @php
                    $i = 0;
                @endphp
                <div class="">
                    <h2 class="h2TopTracks">Populares</h2>
                </div>
                @foreach ($topTracks['tracks'] as $obj)
                    @php
                        $i++;
                    @endphp
                    <div class="contentTopTracks">
                        <div class="flexStartAlign justifyCenter">{{ $i }}</div>
                        <div class="flexStartAlign">
                            <div style="padding-top: 1em;">
                                <img src="{{ $obj['album']['images']['2']['url'] }}">
                            </div>
                            <div class="topTrack">
                                <span class="">{{ $obj['name'] }}</span>
                            </div>
                        </div>
                        <div class="flexStartAlign">

                            <a class="hrefArtistaAlbum"
                                href="{{ route('spotify.albumByID', ['idalbum' => $obj['album']['id']]) }}">{{ $obj['album']['name'] }}</a>
                        </div>
                        <div class="flexStartAlign justifyCenter">
                            <a data-toggle="tooltip" data-placement="top"
                                title="Reproducir {{ $obj['name'] }} en Spotify" class="playsong"
                                href="{{ $obj['external_urls']['spotify'] }}" target="_blank" rel="noopener noreferrer">
                                <i class="far fa-play-circle "></i>
                            </a>
                        </div>
                        <div class="flexStartAlign topTrackMin">{{ date('i:s', $obj['duration_ms'] / 1000) }}</div>
                    </div>
                @endforeach

            </div>
        @endif
        @if (@isset($albums['items']))
            <div class="">
                <h2 class="h2Albums">Álbumes</h2>
            </div>
            <div class=contentAlbumsArtist>
                @foreach ($albums['items'] as $obj)
                    <div>
                        <div class="divIntALbum">
                            <a href="{{ route('spotify.albumByID', ['idalbum' => $obj['id']]) }}">
                                <img class="imgAlbum" src="{{ $obj['images']['1']['url'] }}">
                                <div class="py-4">
                                    <div class="titleAlbum fontFIAlbum">
                                        <span>{{ $obj['name'] }}</span>
                                    </div>
                                    <div class="titleAlbum fontFIAlbum">
                                        <span>{{ date('Y', strtotime($obj['release_date'])) }}</span><span
                                            class="typeTextAlbum text-capitalize">{{ $obj['type'] }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
{{-- {{ dump($artist["followers"]["total"]) }} --}}
{{-- {{ dump($albums) }} --}}
{{-- {{ dump($topTracks)}} --}}
