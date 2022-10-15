<?php
namespace App\Traits;


use Modules\Bocetos\Entities\Boceto;

trait HasBocetos
{
    public function bocetosCreados()
    {
        return $this->hasMany(Boceto::class, "bocetoCreador", "user_id");
    }

}
