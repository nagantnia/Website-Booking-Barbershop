<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use CrudTrait;

    protected $fillable = [
        'user_id',
        'full_name',
        'phone_number',
        'barber_id',
        'booking_datetime',
        'total_price',
        'status'
    ];

    protected $casts = [
        'booking_datetime' => 'datetime',
        'total_price' => 'decimal:2'
    ];

    // Relationship with Services (Many-to-Many)
    public function services()
    {
        return $this->belongsToMany(Pricing::class, 'booking_services')
                    ->withPivot('price')
                    ->withTimestamps();
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Barber
    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }
}
