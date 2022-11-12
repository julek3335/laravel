<?php

namespace App\Models;

use App\Enums\InsuranceStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insurance extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'policy_number',
        'expiration_date',
        'cost',
        'phone_number',
        'vehicle_id',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => InsuranceStatusEnum::class
    ];

    /**
     * Relation to Vehicle
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
