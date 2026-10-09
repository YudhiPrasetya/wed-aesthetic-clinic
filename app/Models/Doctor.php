<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'specialization',
        'image',
        'description',
        'email',
        'phone',
        'daily_jobs_quota'
    ];

    public function bookings(): HasMany
    {
        // return $this->hasMany(Booking::class, 'id', 'docter_id');
        return $this->hasMany(Booking::class);
    }
}
