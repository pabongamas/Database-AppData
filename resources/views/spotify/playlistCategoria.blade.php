@extends('layouts.app')
@section('section-picture')
    <section>
        <div>
            @isset($info)
                @if (session()->get('tokenSpotify') !== null)
                    <div class=" flexendSession"
                        style="padding-top: 15px;background-color: {{ HelperColor::colorPrimary($info['images']['0']['url']) }}">
                        @include('partials.infoMeSpotify')
                    </div>
                @endif
                <div class="fontImgAlbum flexEndAlign transAlbum"
                    style="background-color: {{ HelperColor::colorPrimary($info['images']['0']['url']) }}">
                    <div class="divInfoArtista">
                        <img class="boxShadowAlbum hPlaylistw" src="{{ $info['images']['0']['url'] }}">
                    </div>
                    <div style="padding-left: 0;" class="divInfoArtista">
                        <span>
                            <h5 class="nameArtistImg fontFIAlbum text-capitalize">{{ $info['type'] }}</h5>
                        </span>
                        <span>
                            <h1 class="nameArtistImg fontFIAlbum">{{ $info['name'] }}</h1>
                        </span>
                        <span>
                            <h5 style="font-weight: normal;" class="nameArtistImg fontFIAlbum">{{ $info['description'] }}</h5>
                        </span>
                        <span classflexStartAlign>
                            <a class="hrefArtistaAlbum"
                                href="{{ route('spotify.userByID', $info['owner']['id']) }}">{{ $info['owner']['display_name'] }}</a>
                            <span style="font-weight: normal"
                                class="nameArtistImg fontFIAlbum typeTextAlbum ">{{ number_format($info['followers']['total'], 0, '.', '.') }}
                                "Me gusta"</span>
                            <span style="font-weight: normal"
                                class="nameArtistImg fontFIAlbum typeTextAlbum ">{{ number_format($info['tracks']['total'], 0, '.', '.') }}
                                Canciones</span>

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
        style="padding: 20px;
        ;background:linear-gradient(180deg,{{ HelperColor::colorPrimary($info['images']['0']['url']) }} -30%, #6b6868 50%)">
        @if (@isset($playlist))
            <div class="">
                @php
                    $i = 0;
                @endphp
                <div class="contentTracksPlaylist">
                    <div class="flexStartAlign justifyCenter">#</div>
                    <div class="flexStartAlign">Titulo</div>
                    <div class="flexStartAlign">Álbum</div>
                    <div class="flexStartAlign">Fecha incorporación</div>
                    <div class="flexStartAlign justifyCenter">
                        <i class="far fa-clock"></i>
                    </div>
                </div>
                @foreach ($playlist as $song)
                    @php
                        $i++;
                    @endphp
                    <div class="contentTopTracks">
                        <div class="flexStartAlign justifyCenter">{{ $i }}</div>
                        <div class="flexStartAlign">
                            <div style="padding-top: 1em;">
                                @isset($song['track']['album']['images']['2'])
                                    <img src="{{ $song['track']['album']['images']['2']['url'] }}">
                                @endisset
                            </div>
                            <div class="topTrack breakWord">
                                <span class="">{{ $song['track']['name'] }}</span><br>
                                <span>
                                    @foreach ($song['track']['album']['artists'] as $artist)
                                        <a class="hrefArtistaAlbum"
                                            href="{{ route('spotify.artistByID', $artist['id']) }}">{{ $artist['name'] }}</a>
                                    @endforeach
                                </span>
                            </div>
                        </div>
                        <div class="flexStartAlign">
                            <a class="hrefArtistaAlbum"
                                href="{{ route('spotify.albumByID', ['idalbum' => $song['track']['album']['id']]) }}">{{ $song['track']['album']['name'] }}</a>
                        </div>
                        <div class="flexStartAlign topTrackMin">
                            <span>{{ date('d-m-Y', strtotime($song['added_at'])) }}</span>
                        </div>
                        <div class="flexStartAlign topTrackMin">
                            <span>{{ date('i:s', $song['track']['duration_ms'] / 1000) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-12 col-lg-12 col-md-12" style="display: flex;justify-content: center;">
                {{ $playlist->links('pagination::bootstrap-4') }}
            </div>
        @endif



    </div>
@endsection
