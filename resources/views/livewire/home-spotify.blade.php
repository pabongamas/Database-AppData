@extends('layouts.app')
@section('content-fluid')
    <div class="container-fluid">
        <div class="row">
            <input type="hidden" id='hidden_token' value="{{ session()->get('tokenSpotify') }}">
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse sidebarHome" style="">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('spotify.indexApi') }}">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#">Buscar</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

@endsection
