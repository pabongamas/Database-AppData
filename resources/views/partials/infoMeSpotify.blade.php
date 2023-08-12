@php
    $me=session()->get('meData');
@endphp
<button class="btn btn-primary btnSeccSpo" id="infoUserDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <figure>
        <img src="{{$me['images']['0']['url']}}">
    </figure>
    <span>{{ $me["display_name"] }}</span>
</button>
<div class="dropdown-menu" aria-labelledby="infoUserDrop">
    <a class="dropdown-item" href="{{ route('spotify.home')}}">Inicio</a>
    <a class="dropdown-item" href="{{ route('spotify.userByID', ['iduser' => $me['id']]) }}">Perfil</a>
    <a class="dropdown-item" href="#">Cerrar sesión</a>
  </div>
