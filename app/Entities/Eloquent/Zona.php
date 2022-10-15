<?php

namespace App\Entities\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Archivos\Entities\Organismo;

class Zona extends Model
{
    use HasFactory;

    protected $table = "zonas";
    protected $keyType = 'boolean';
    public $incrementing = false;
    public $timestamps = false;


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Comprobantes\Database\factories\ZonaFactory::new();
    }

    protected $fillable = [
        'prv_id',
        'municipalidad_id',
        'estado',
        'descripcion',
        'created_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organismos()
    {
        return $this->hasMany(Organismo::class);
    }
}
