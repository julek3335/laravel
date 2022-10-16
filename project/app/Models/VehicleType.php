<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleType extends Model
{
    use HasFactory;

    public function registrationCard()
    {
        return $this->belongsTo(RegistrationCard::class);
    }
}
