<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['pricing_name', 'harga'];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_services')
                    ->withPivot('price')
                    ->withTimestamps();
    }
}
