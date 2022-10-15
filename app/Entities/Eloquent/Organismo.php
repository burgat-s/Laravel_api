<?php

namespace App\Entities\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organismo extends Model
{
    use HasFactory;

    protected $table = 'organismos';
    public $timestamps = true;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Comprobantes\Database\factories\OrganismoFactory::new();
    }

    protected $fillable = [
        'descripcion',
        'slug',
        'cuit',
        'municipalidad_id',
        'calle',
        'calle_numero',
        'piso',
        'torre',
        'codigo_postal',
        'situacion_iva',
        'codigo_area_1',
        'telefono_1',
        'codigo_area_2',
        'telefono_2',
        'email',
        'ciudad',
        'zona_id',
        'updated_at'
    ];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuarios_organismos');
    }

    // public function ftpExterno()
    // {
    //     return $this->hasOne(FtpExterno::class, 'orgID', 'orgID');
    // }

    public function puedeSubirArchivos()
    {
        return $this->ftpExterno()->exists();
    }

    public function zona() {
        return $this->belongsTo(Zona::class);
    }

    public function municipalidad() {
        return $this->belongsTo(Municipalidad::class);
    }

    // public function comprobantes() {
    //     return $this->hasMany(Comprobante::class, 'orgID', 'orgID');
    // }
}
