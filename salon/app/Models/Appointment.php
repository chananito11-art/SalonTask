<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'service_id',
        'date',
        'time',
        'total_price',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'total_price' => 'decimal:2',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
