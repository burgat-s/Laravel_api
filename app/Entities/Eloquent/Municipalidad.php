<?php

namespace App\Entities\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Archivos\Entities\Organismo;
use Modules\Bocetos\Database\factories\MunicipalidadFactory;

class Municipalidad extends Model
{
    use HasFactory;

    protected $table = 'municipalidades';
    public $timestamps = true;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return MunicipalidadFactory::new();
    }

    protected $fillable = [
        'estado',
        'tipo',
        'razon_social',
        'codigo_postal',
        'direccion',
        'zona_id',
        'telefono',
        'fax',
        'email',
        'web',
        'poblacion',
        'flag',
        'banco_id',
        'cuenta',
        'cuit',
        'orden',
        'cbu',
        'ip',
        'fecha_alta',
        'deleted_at',
        'fecha_ultimo_ingreso',
        'operador_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organismos()
    {
        return $this->hasMany(Organismo::class, 'id', 'id');
    }
}
