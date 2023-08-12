@extends('layouts.app')
@section('content-fluid')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <input type="hidden" id='hidden_token' value="{{ Session::get('token') }}">
                @include('partials.session-status')
            </div>

        </div>
    </div>
@endsection
