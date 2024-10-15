<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    protected $fillable = [
        'payment_id',
        'total_amount',
    ];
    public function payment()
    {
        return $this->belongsTo(Payment::class,'payment_id');
    }
}
