<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration_minutes',
        'discount',
        'is_active',
        'daily_quotas'
    ];

    public function Bookings(): HasMany
    {
        return $this->hasMany(booking::class, 'service_id', 'id');
    }
}
