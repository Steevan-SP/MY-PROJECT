<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalGuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'addressline1',
        'addressline2',
        'city',
        'phone',
        'id_number',
        'user_id',
        'ticket_id',
        'guest_id',
        'registration_date', // Include this if mass-assigning
    ];

    protected $casts = [
        'registration_date' => 'date', // Ensure registration_date is cast to a Carbon instance
    ];

    /**
     * Define the relationship with the Guest model.
     */
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    /**
     * Boot method to handle model events.
     */
    protected static function boot()
    {
        parent::boot();

        // Ensure registration_date is set to the current date if not provided
        static::creating(function ($model) {
            if (is_null($model->registration_date)) {
                $model->registration_date = Carbon::now()->toDateString();
            }
        });
    }
}