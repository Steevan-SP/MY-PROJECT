<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignGuest extends Model
{
    protected $fillable = [
        'country',
        'passport_number',
        'image_path',
        'driver_name',
        'vehicle_number',
        'user_id',
        'ticket_id',
        'guest_id',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
 
}
