<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'billing_details', 
        'total_amount',
    ];
   
    protected $casts = [
        'billing_details' => 'array',
    ];

    protected function billing_details(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}