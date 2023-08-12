<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class relMovieUserRequest extends FormRequest
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
            'idpelicula'=>'required|not_in:none',
            'calificacion'=>'required|not_in:none',
        ];
    }
    public function messages(){
        return [
            'idpelicula.not_in'=>'No ha seleccionado la pelicula',
            'calificacion.not_in'=>'No ha seleccionado la Calificación',
        ];
    }
}
