<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAllocation extends Model
{
    protected $fillable = [
        'user_id',
        'staff_name',
        'location',
        'phone_number',
        'start_date',
        'end_date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
