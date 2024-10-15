<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receptionist extends Model
{
    use HasFactory;
    #
    protected $fillable = [
        'user_id'   ,
        'firstname' ,
        'lastname'  ,
        'email'     , 
        'password'  ,      
        'address'   ,
        'id_number' ,
        'phone'     ,
        'epfnumber' 
];

public function user(){
    return $this->hasone(User::class,'user_id');
}
public function guests()
{
    return $this->hasMany(Guest::class,'user_id');
}
}
