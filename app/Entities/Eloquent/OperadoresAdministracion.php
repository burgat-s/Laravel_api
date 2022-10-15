<?php


namespace App\Entities\Eloquent;


use Illuminate\Database\Eloquent\Model;

class OperadoresAdministracion extends Model
{
    protected $table = "safOperadoresAdministracion";

    public $timestamps = false;

    protected $primaryKey =  'opeID';
}
