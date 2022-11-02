<?php

namespace App\Models;

use App\Enums\VehicleStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function incidents(): HasMany
    {
        return $this->hasMany(Incident::class);
    }

    public function insurance(): HasOne
    {
        return $this->hasOne(Insurance::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function qualifications(): BelongsToMany
    {
        return $this->belongsToMany(Qualification::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);

    public function jobs():BelongsToMany
    {
        return  $this->belongsToMany(Job::class);
    }
}
