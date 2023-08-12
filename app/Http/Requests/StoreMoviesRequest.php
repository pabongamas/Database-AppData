<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMoviesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titulo'=>'required|string|max:100',
            'genero'=>'required|string|max:20',
            'duracion'=>'required|string|max:20',
            'resumen'=>'required|string|max:1000',
            'director'=>'required|string|max:100',
            'urlubicacion'=>'required|string|max:200',
            'clasificacion'=>'required|string|max:25|not_in:none',
            'anioestreno' => 'required|string'
        ];

    }
    public function messages(){
        return [
            'titulo.required'=>'El titulo es requerido',
            'titulo.max'=>'El titulo tiene un maximo de 100 caracteres',
            'genero.required'=>'El genero de la pelicula es requerido',
            'genero.max'=>'El genero tiene un maximo de 20 caracteres',
            'duracion.required'=>'La duracion de la pelicula es requerida',
            'duracion.max'=>'La duración tiene un maximo de 20 caracteres',
            'resumen.required'=>'El resumen es requerido',
            'resumen.max'=>'El resumen tiene un maximo de 1000 caracteres',
            'director.required'=>'El director es requerido',
            'director.max'=>'El director tiene un maximo de 100 caracteres',
            'urlubicacion.required'=>'La url es requerido',
            'urlubicacion.max'=>'La url tiene un maximo de 200 caracteres',
            'clasificacion.required'=>'La clasificacion es requerido',
            'clasificacion.max'=>'La clasificacion tiene un maximo de 25 caracteres',
            'clasificacion.not_in'=>'No ha seleccionado la clasificación de la pelicula',
            'anioestreno.required'=>'El año de estreno es requerida'
        ];
    }
}
