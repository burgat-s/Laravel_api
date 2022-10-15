<?php

namespace App\Entities\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boceto extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = "bocetos";
}
