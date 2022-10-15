<?php

namespace Modules\Organismos\Http\Requests;

use App\ApiValidationRequest\ApiRequest;
use Illuminate\Validation\Rule;
use Modules\Organismos\Entities\Organismo;

class OrganismosUpdateRequest extends APIRequest
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
            'descripcion' => [
                'required', 'string',
                Rule::unique(Organismo::class)
                    ->where(function ($query) {
                        return $query
                            ->where(['descripcion' => request()->orgDescripcion, 'id' => request()->orgID]);
                    }),
            ],
            'estado' => 'in:A,B',
            'cuit' => 'required|numeric|digits:11',
            'email' => 'required|string|email|max:255',
            'calle' => 'required|string|max:255',
            'calle_numero' => 'required|numeric',
            'piso' => 'nullable|numeric',
            'torre' => 'nullable|numeric',
            'codigo_postal' => 'nullable|numeric',
            'situacion_iva' => 'required|in:Exento,Responsable Inscripto',
            'codigo_area_1' => 'numeric|nullable',
            'codigo_area_2' => 'numeric|nullable',
            'numero_telefono_1' => 'numeric|nullable',
            'numero_telefono_2' => 'numeric|nullable',
            'ciudad' => 'string|max:255|nullable',

//            'zona_id' => 'numeric|nullable',
//            'municipalidad_id' => 'numeric|nullable',
            'zona_id' => 'required|exists:Modules/Municipalidades/Entities/Zona,zonID',
            'municipalidad_id' => 'required|exists:Modules/Municipalidades/Entities/Municipalidad,munID'
        ];
    }
}
