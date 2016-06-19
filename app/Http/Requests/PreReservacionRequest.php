<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PreReservacionRequest extends Request
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
            'fechaLlegada.required'  => 'La fecha de llegada es requerida',
            'fechaLlegada.date'  => 'La fecha de llegada ingresada no es una fecha válida',
            'fechaLlegada.after'  => 'La fecha de llegada debe ser posterior al día de hoy',
            'fechaIda.required'  => 'La fecha de ida es requerida',
            'fechaIda.date'  => 'La fecha de ida ingresada no es una fecha válida',
            'fechaIda.after'  => 'La fecha de ida debe ser posterior a la fecha de llegada',
            'personas.required'  => 'El número de personas es requerido',
            'personas.integer'  => 'El campo personas solo acepta números',
            'personas.max'  => 'El número de personas no puede exeder de 7'
        ];
    }
}
