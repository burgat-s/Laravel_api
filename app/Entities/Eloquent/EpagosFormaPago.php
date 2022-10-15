<?php

namespace App\Entities\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Entities\Eloquent\Epagos;

class EpagosFormaPago extends Model
{
    use HasFactory;

    protected $table = 'impEpagosFormasPago';
    protected $primaryKey = 'efpID';
    protected $keyType = 'integer';
    public $timestamps = false;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        // return \Database\Factories\EpagosFormaPagoFactory::new();
    }

    protected $fillable = [
        'efpCodigoPagoFp',
        'efpCodigoBarrasFp',
        'efpFechaVencFp',
        'efpImporteFp',
        'efpPdfDireccion',
        'efpCodigoBarrasImagen',
        'efpQrImagen',
        'efpRespuestaEntidadCobro',
        'efpCodigoPmc',
        'efpCodigoLink',
        'efpUrlQr',
        'epgID'
    ];

    // public function epago()
    // {
    //     return $this->hasOne(Epagos::class, 'epgID', 'epgID');
    // }
}
