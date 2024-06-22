<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'hostel_id',
        'name',
        'type',
        'price',
        'description',
        'duration',
        'status',
    ];
    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }
}
