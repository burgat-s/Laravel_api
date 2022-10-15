<?php


namespace Modules\Organismos\Entities;


use App\Models\User;
use Modules\Archivos\Entities\FtpExterno;
use Modules\Comprobantes\Entities\Comprobante;
use Modules\Municipalidades\Entities\Municipalidad;
use Modules\Zonas\Entities\Zona;

class Organismo extends \App\Entities\Eloquent\Organismo
{
    protected $table = 'organismos';

    protected $fillable = [
        "estado",
        "descripcion",
        "slug",
        "cuit",
        "calle",
        "calle_numero",
        "piso",
        "torre",
        "codigo_postal",
        "situacion_iva",
        "codigo_area_1",
        "numero_telefono_1",
        "codigoarea_2",
        "numero_telefono_2",
        "email",
        "ciudad",
        "municipalidad_id",
        "zona_id",
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d h:i',
        'updated_at' => 'datetime:Y-m-d h:i',
        'deleted_at' => 'datetime:Y-m-d h:i'
    ];

    public function update( array $request = [], array $options = [])
    {
        if (!array_key_exists( 'codigo_area_2', $request) && !array_key_exists('numero_telefono_2',$request)) {
            $request['codigo_area_2'] = null;
            $request['numero_telefono_2'] = null;
        }
        parent::update($request,$options);
    }


    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'impUsuariosOrganismos', 'orgID', 'usuID');
    }

    public function puedeSubirArchivos()
    {
        return $this->ftpExterno()->exists();
    }

    public function ftpExterno()
    {
        return $this->hasOne(FtpExterno::class, 'id', 'id');
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class, 'zona_id', 'id');
    }

    public function municipalidad()
    {
        return $this->belongsTo(Municipalidad::class, 'municipalidad_id', 'id');
    }

    public function comprobantes()
    {
        return $this->hasMany(Comprobante::class, 'organismo_id', 'id');
    }
}
