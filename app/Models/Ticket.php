<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    protected $fillable = [
        
        'sl_price',
        'sl_price_kids',
        'foreign_price',
        'foreign_price_kids'

        
    ];
     public function admin() {

            return $this->belongsTo(Admin::class, 'admin_id'); 
        }
        public function guests()
        {
            return $this->hasMany(Guest::class,'user_id');
        }
        public function user()
        {
            return $this->belongsTo(User::class,'user_id');}

            public function payments()
    {
        return $this->hasMany(Payment::class);
    }
        }
