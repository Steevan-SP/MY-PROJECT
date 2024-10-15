<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplementaryGuest extends Model
{
    protected $fillable = [
        'user_id',
        'ticket_id',
        'guest_id',
        'complementary_reason'
    ];
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
