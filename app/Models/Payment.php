<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = [
        'guest_id',
        'user_id',
        'ticket_id',
        'total_adults_price',
        'total_kids_price',
        'payment_mode',
        'total_amount',
        'bill_number',
        'ticket_number',
    ];
    
    public function guest()
    {
        return $this->belongsTo(Guest::class,'guest_id');
    }
    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function cardPayment()
    {
        return $this->morphOne(CardPayment::class, 'paymentable');
    }
     public function cash()
    {
        return $this->morphOne(Cash::class, 'paymentable');
    }
   
    public function billings()
{
    return $this->belongsTo(Billing::class, 'billing_id');
}
}
