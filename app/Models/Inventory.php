<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'item_name',
        'quantity',
        'code',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
