<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Organismos\Entities\Organismo;

/**
 * Trait HasOrganismos
 * @property Organismo $organismo
 * @package App\Models\Traits
 */
trait HasOrganismos {

    public function organismo(): BelongsTo
    {
        return $this->belongsTo(Organismo::class, 'id','organismo_id');
    }

    public function assignOrganismo(Organismo $organismo)
    {
        $this->organismo()->associate($organismo);
    }

    public function desasignOrganismo()
    {
        $this->organismo()->dissociate();
    }
}
