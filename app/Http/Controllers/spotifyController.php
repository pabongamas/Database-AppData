<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Session;

class spotifyController extends Controller
{
    private $tokenSpotify = null;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function indexSpotify(request $request)
    {
        $token = session('tokenSpotify');
        if ($token === null) {
            return view('spotify.index');
        } else {
            return redirect()->route('spotify.indexApi')->with('token', $token);
        }

    }

    public function indexApi(Request $request)
    {
        $page = isset($request->page) ? $request->page : 1;
        $limit = 50;
        $offset = 0;
        $url = 'https://api.spotify.com/v1/browse/categories?locale=sv_CO&offset=' . $offset . '&limit=' . $limit;
        $clientId = Config::get("constants.clientId");
        $clientSecret = Config::get("constants.clientSecret");
        $token = session('tokenSpotify');
        if ($token === null) {
            /* obtener token */
            $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
                'grant_type' => 'client_credentials',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'scope' => '',
            ]);
            $data = $response->collect();
            $token = $data["access_token"];
        }
        /* consultar categorias  */
        $responseGeneros = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get($url);
        $generos = $responseGeneros->collect();

        $itemsGeneros = $generos["categories"]["items"];
        $limit = $generos["categories"]["limit"];
        $offset = $generos["categories"]["offset"];
        $next = $generos["categories"]["next"];
        $previous = $generos["categories"]["previous"];
        $totalItems = $generos["categories"]["total"];

        $data = new LengthAwarePaginator($itemsGeneros, $totalItems, $limit, $page, ['path' => url('/spotify'), 'pageName' => 'page']);
        return view('spotify.indexApi', ["token" => $token, "dataGeneros" => $data]);
    }
    public function getCategoriasById(Request $request)
    {
        $categoria = $request->route('idCategoria');
        $clientId = Config::get("constants.clientId");
        $clientSecret = Config::get("constants.clientSecret");

        $page = isset($request->page) ? $request->page : 1;
        $limit = 50;
        $offset = 0;
        $url = 'https://api.spotify.com/v1/browse/categories/' . $categoria . '/playlists';
        $urlInfo = 'https://api.spotify.com/v1/browse/categories/' . $categoria;
        $token = session('tokenSpotify');
        if ($token === null) {
            $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
                'grant_type' => 'client_credentials',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'scope' => '',
            ]);
            $data = $response->collect();
            $token = $data["access_token"];
        }
        /* consultar playlist por categorias */
        $responseGenero = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get($url);
        $genero = $responseGenero->collect();
        $responseInfo = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get($urlInfo);
        $info = $responseInfo->collect();

        $itemsGenero = $genero["playlists"]["items"];
        $limit = $genero["playlists"]["limit"];
        $offset = $genero["playlists"]["offset"];
        $next = $genero["playlists"]["next"];
        $previous = $genero["playlists"]["previous"];
        $totalItems = $genero["playlists"]["total"];

        $data = new LengthAwarePaginator($itemsGenero, $totalItems, $limit, $page, ['path' => url('/spotify/categorias/' . $categoria), 'pageName' => 'page']);
        return view('spotify.PlaylistCategorias', ["token" => $token, "dataGenero" => $data, "info" => $info]);
    }
    public function TracksByGenero(Request $request)
    {
      /*   dump($request);
        exit(); */
        $idplaylist = $request->route('idplaylist');

        $clientId = Config::get("constants.clientId");
        $clientSecret = Config::get("constants.clientSecret");

        $page = isset($request->page) ? $request->page : 1;
        $limit = 50;
        $offset = 0;
        $url = 'https://api.spotify.com/v1/playlists/' . $idplaylist . '';
        $token = session('tokenSpotify');
        if ($token === null) {
            $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
                'grant_type' => 'client_credentials',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'scope' => '',
            ]);
            $data = $response->collect();
            $token = $data["access_token"];
        }
        /* consultar canciones de una playlist */
        $responsePlaylist = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get($url);
        $playlist = $responsePlaylist->collect();

        $itemsPlaylist = $playlist["tracks"]["items"];
        $limit = $playlist["tracks"]["limit"];
        $offset = $playlist["tracks"]["offset"];
        $next = $playlist["tracks"]["next"];
        $previous = $playlist["tracks"]["previous"];
        $totalItems = $playlist["tracks"]["total"];
        $info = $playlist;

        $data = new LengthAwarePaginator($itemsPlaylist, $totalItems, $limit, $page);
        return view('spotify.playlistCategoria', ["token" => $token, "playlist" => $data, "info" => $info]);
    }
    public function albumByID(Request $request)
    {
        $idalbum = $request->route('idalbum');

        $clientId = Config::get("constants.clientId");
        $clientSecret = Config::get("constants.clientSecret");

        $page = isset($request->page) ? $request->page : 1;
        $limit = 50;
        $offset = 0;
        $url = 'https://api.spotify.com/v1/albums/' . $idalbum;
        $token = session('tokenSpotify');
        if ($token === null) {
            $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
                'grant_type' => 'client_credentials',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'scope' => '',
            ]);
            /* consultar album por id */
            $data = $response->collect();
            $token = $data["access_token"];
        }
        $responseAlbum = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get($url);
        $album = $responseAlbum->collect();
        return view('spotify.albumById', ["token" => $token, "album" => $album]);
    }
    public function artistByID(Request $request)
    {
        $idartist = $request->route('idartist');

        $clientId = Config::get("constants.clientId");
        $clientSecret = Config::get("constants.clientSecret");

        $page = isset($request->page) ? $request->page : 1;
        $limit = 50;
        $offset = 0;
        $url = 'https://api.spotify.com/v1/artists/' . $idartist;
        $token = session('tokenSpotify');
        if ($token === null) {
            $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
                'grant_type' => 'client_credentials',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'scope' => '',
            ]);
            $data = $response->collect();
            $token = $data["access_token"];
        }
        /* CONSULTAR INFO ARTISTA */
        $responseArtist = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get($url);
        $artist = $responseArtist->collect();

        $urlAlbumArtist = 'https://api.spotify.com/v1/artists/' . $idartist . '/albums';
        /* CONSULTAR ALBUM DEL ARTISTA */
        $responseAlbums = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get($urlAlbumArtist);
        $albums = $responseAlbums->collect();

        $urlTopTracks = 'https://api.spotify.com/v1/artists/' . $idartist . '/top-tracks?market=CO';
        /* CONSULTAR TOP CANCIONES DEL ARTISTA */
        $responseTop = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get($urlTopTracks);
        $topTracks = $responseTop->collect();
        return view('spotify.artistaById', ["token" => $token, "albums" => $albums, "artist" => $artist, "topTracks" => $topTracks]);
    }
    public function userByID(Request $request)
    {
        $iduser = $request->route('iduser');

        $clientId = Config::get("constants.clientId");
        $clientSecret = Config::get("constants.clientSecret");

        $page = isset($request->page) ? $request->page : 1;
        $limit = 50;
        $offset = 0;
        $url = 'https://api.spotify.com/v1/users/' . $iduser;
        $token = session('tokenSpotify');
        if ($token === null) {
            $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
                'grant_type' => 'client_credentials',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'scope' => '',
            ]);
            $data = $response->collect();
            $token = $data["access_token"];
        }

        /* CONSULTAR INFO user */
        $responseuser = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get($url);
        $user = $responseuser->collect();
        /* dump($user);
        exit; */
        return view('spotify.userById', ["token" => $token, "user" => $user]);

    }
    public function loginSpotify(request $request)
    {
        $clientId = Config::get("constants.clientId");
        $clientSecret = Config::get("constants.clientSecret");
        $urlRedirect = URL::to('/autorizadoLogin');

        $scopes = 'user-read-private user-read-email';
        return redirect(
            'https://accounts.spotify.com/authorize' .
            '?response_type=code' .
            '&client_id=' . $clientId .
            ($scopes ? '&scope=' . urlencode($scopes) : '') .
            '&redirect_uri=' . urlencode($urlRedirect)
        );
    }
    public function autorizadoLogin(request $request)
    {
        $code = $request->code;
        $clientId = Config::get("constants.clientId");
        $clientSecret = Config::get("constants.clientSecret");
        $urlRedirect = URL::to('/autorizadoLogin');

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($clientId . ':' . $clientSecret),
        ])->asForm()
            ->post('https://accounts.spotify.com/api/token', [
                'code' => trim($code),
                'redirect_uri' => $urlRedirect,
                'grant_type' => 'authorization_code',
            ]);
        $data = $response->collect();
        $token = $data["access_token"];
        session(['tokenSpotify' => $token]);
        return redirect()->route('spotify.indexMe')->with('token', $token);
    }
    public function indexMe(request $request)
    {
        /*      $token = Session::get('token');
        $token =$this->tokenSpotify;
        dump($token);
        exit; */
        $token = session('tokenSpotify');
        $clientId = Config::get("constants.clientId");
        $clientSecret = Config::get("constants.clientSecret");

        $me = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://api.spotify.com/v1/me');
        $meObj = $me->collect();
        session(['meData' => $meObj]);
        return redirect()->route('spotify.index')->with('token', $token);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [], $totalItems = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $paginador = new LengthAwarePaginator($items, $totalItems, $perPage, $page, $options);
        return $paginador;
    }
}
