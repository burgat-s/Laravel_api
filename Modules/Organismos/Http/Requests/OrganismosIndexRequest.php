<?php

namespace Modules\Organismos\Http\Requests;

use App\ApiValidationRequest\ApiRequest;
use Illuminate\Validation\Rule;
use Modules\Organismos\Entities\Organismo;

class OrganismosIndexRequest extends APIRequest
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
            'id' => 'nullable|int',
            'per_page' => 'nullable|int',
            'page' => 'nullable|int',
            'estado' => 'nullable|in:A,B',
            'cuit' => 'nullable|int|max:99999999999',
            'email' => 'nullable|email|max:255',
            'descripcion' => 'nullable|string',
            'calle' => 'nullable|string|max:255',
            'calle_numero' => 'nullable|int',
            'piso' => 'nullable|int',
            'torre' => 'nullable|int',
            'codigo_postal' => 'nullable|int',
            'situacion_iva' => 'nullable|in:Exento,Responsable Inscripto',
            'codigo_area_1' => 'int|nullable',
            'codigo_area_2' => 'int|nullable',
            'numero_telefono_1' => 'int|nullable',
            'numero_telefono_2' => 'int|nullable',
            'ciudad' => 'string|max:255|nullable',
            'zona_id' => 'nullable|int',
            'municipalidad_id' => 'nullable|int'
        ];
    }
}
