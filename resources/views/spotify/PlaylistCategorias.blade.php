@extends('layouts.app')
@section('section-picture')
    <section>
        <div>

            @isset($info)
            @if (session()->get('tokenSpotify') !== null)
                <div class=" flexendSession" style="padding-top: 15px;background-color: {{ HelperColor::colorPrimary($info['icons']['0']['url']) }}">
                    @include('partials.infoMeSpotify')
                </div>
            @endif
                <div class="fontImgAlbum flexEndAlign transAlbum"
                    style="background-color: {{ HelperColor::colorPrimary($info['icons']['0']['url']) }}">
                    <div class="divInfoArtista">
                        <img class="boxShadowAlbum" style="width:100%" src="{{ $info['icons']['0']['url'] }}">
                    </div>
                    <div style="padding-left: 0;" class="divInfoArtista">

                        <span>
                            <h1 class="nameArtistImg fontFIAlbum">{{ $info['name'] }}</h1>
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
        background:linear-gradient(180deg,{{ HelperColor::colorPrimary($info['icons']['0']['url']) }} -30%, #6b6868 50%)">
        @if (@isset($dataGenero))
            <div class=contentCategories>
                @foreach ($dataGenero as $genero)
                    <div>
                        <div class="divIntALbum">
                            <a href="{{ route('spotify.TracksByGenero', ['idplaylist' => $genero['id']]) }}">
                                <img class="imgAlbum" src="{{ $genero['images'][0]['url'] }}">
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
                {{ $dataGenero->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection
