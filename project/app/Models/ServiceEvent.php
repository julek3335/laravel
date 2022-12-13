<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'service_id',
        'status',
        'note',
        'event_date'
    ];

    public function vehicle(): BelongsTo
    {
        return $this->BelongsTo(Vehicle::class);
    }

    public function service(): BelongsTo
    {
        return $this->BelongsTo(Service::class);
    }
}
