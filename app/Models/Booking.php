<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $fillable = [
        'customer_id', 'doctor_id', 'service_id', 'booking_date', 'booking_time', 'status', 'notes'
    ];

    public function customer(): HasOne{
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    // public function doctor(): HasOne{
    //     return $this->hasOne(Doctor::class, 'id', 'doctor_id');
    // }

    public function doctor(): BelongsTo{
        return $this->belongsTo(Doctor::class);
    }

    public function service(): HasOne{
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}
