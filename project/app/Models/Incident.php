<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'description',
        'photo',
        'address',
        'vehicle_id',
    ];

    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
}
