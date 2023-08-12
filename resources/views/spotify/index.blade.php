@extends('layouts.app')
@section('content-fluid')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
               {{--  <input type="hidden" id='hidden_token' value="{{ $token }}"> --}}
                @include('partials.session-status')
            </div>

        </div>
    </div>
    <div class="container-fluid fontContainerAlbum divHtotal flexCenterAlign" style="padding: 20px;">
        <div>
            <form method="POST" action="{{ route('spotify.loginSpotify')}}">
                @csrf
                <button class="btn btn-success" type="submit">Login Spotify</button>
            </form>
        </div>

    </div>
@endsection
