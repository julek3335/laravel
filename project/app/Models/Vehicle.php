<?php

namespace App\Models;

use App\Enums\VehicleStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * Relation to Registration cards
     * @return HasMany
     */
    public function registrationCards(): HasMany
    {
        return $this->hasMany(RegistrationCard::class);
    }

    protected $casts = [
        'status' => VehicleStatusEnum::class,
    ];
}
