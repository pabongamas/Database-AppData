@extends('layouts.app')
@section('section-picture')
    <section>
        <div>
            @isset($user)
                @if (session()->get('tokenSpotify') !== null)
                    <div class=" flexendSession"
                        style="padding-top: 15px;background-color: {{ HelperColor::colorPrimary($user['images']['0']['url']) }}">
                        @include('partials.infoMeSpotify')
                    </div>
                @endif
                <div class="fontImgAlbum flexEndAlign transAlbum"
                    style="background-color: {{ HelperColor::colorPrimary($user['images']['0']['url']) }}">
                    <div class="divInfoArtista">
                        <img class="boxShadowAlbum hPlaylistw br50" src="{{ $user['images']['0']['url'] }}">
                    </div>
                    <div style="padding-left: 0;" class="divInfoArtista">
                        <span>
                            <h5 class="nameArtistImg fontFIAlbum text-capitalize">{{ $user['type'] }}</h5>
                        </span>
                        <span>
                            <h1 class="nameArtistImg fontFIAlbum">{{ $user['display_name'] }}</h1>
                        </span>

                        <span classflexStartAlign>
                            <span style="font-weight: normal"
                                class="nameArtistImg fontFIAlbum typeTextAlbum ">{{ number_format($user['followers']['total'], 0, '.', '.') }}
                                seguidores</span>
                        </span>

                    </div>
                </div>
            @endisset
        </div>
    </section>
@endsection
