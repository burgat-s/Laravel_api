<?php

namespace App\Entities\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BocetoImagen extends Model
{
    use HasFactory;

    protected $table = "bocetos_imagenes";
    public $timestamps = false;
}
