<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{

    protected $fillable = [
        
        'guest_type',
        'title',
        'guestfirstname',
        'guestlastname',
        'email',
        'adult_count',
        'kids_count',
        'user_id',
        'ticket_id'
    ];
    public function localGuest()
    {
        return $this->hasOne(LocalGuest::class);
    }

    
    public function foreignGuest()
    {
        return $this->hasOne(ForeignGuest::class);
    }

    
    public function complementaryGuest()
    {
        return $this->hasOne(ComplementaryGuest::class);
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class,'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class,'user_id');
    }

    public function receptionist()
    {
        return $this->belongsTo(Receptionist::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
