<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMoviesRequest;
use App\Models\Movie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class movies extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.index');
    }
    public function indexApi()
    {
        return view('movies.indexApi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMoviesRequest $request)
    {
        $movie = Movie::create([
            'titulo' => request('titulo'),
            'genero' => request('genero'),
            'duracion' => request('duracion'),
            'resumen' => request('resumen'),
            'director' => request('director'),
            'urlubicacion' => request('urlubicacion'),
            'clasificacion' => request('clasificacion'),
            'anioestreno' => request('anioestreno')
        ]);
        return redirect()->route('movies.create')->with('status-success', 'La pelicula ' . $movie->titulo . ' fue creada con exito');

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

    public function searchApi(Request $request){
        /* pagina , esta viene de la paginacion si existe el request de page */
        $page=isset($request->page)?$request->page:1;

        $condiciones=array();
        $condiciones[]='s='.$request->titulo.'';
        if($request->tipo==="movie"){
            $condiciones[]='type=movie';
        }else if($request->tipo==="series"){
            $condiciones[]='type=series';
        }else if($request->tipo==="episodes"){
            $condiciones[]='type=episode';
        }
        $condiciones[]='plot=full';
        $condiciones[]='apikey=5363916';
        $condiciones[]='page='.$page.'';
        $parametros=implode("&", $condiciones);

        //esta api key esta por 1000 dias 5363916
       /*  $url='http://www.omdbapi.com/?s='.$request->titulo.'&apikey=5363916&page=10'; */
      /*   $url='https://www.omdbapi.com/?s='.$request->titulo.'&plot=full&apikey=5363916&page='.$page.''; */
        $url='https://www.omdbapi.com/?'.$parametros;
        $response = Http::get($url);
        $data=$response->collect();
        $msj="";
        if($data["Response"]==="True"){
            $data =$this->paginate($data["Search"],10,$page,['path' => url('/searchApi'),'pageName' => 'page'],$data["totalResults"]);
        }else{
            $msj="No se ha encontrado resultados para ".$request->titulo;
            $data=[];
        }
        /* dump($data);
        exit; */
        /* si vamos a mostrar en una vista la data en laravel blade */
        return view('movies.indexApi', [
            'data' => $data,'titulo'=>$request->titulo,'tipo'=>$request->tipo,'msj'=>$msj]);
        /* si es por ajax  */
        /*   return response()->json([
            'data' => $data
        ]); */
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [],$count=null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        /* este siguiente es por si tenemos toda la data , como la api me devuelve de 10 en 10
        ya por pagina ,toncs nocesito hacer el forpage ,le mando solo los items , ya vienen
        paginadas desde la api */
        /* return new LengthAwarePaginator($items->forPage($page, $perPage),$count, $perPage, $page, $options); */
        return new LengthAwarePaginator($items,$count, $perPage, $page, $options);
    }
}
