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
        'num_of_rooms',
        'num_of_beds_per_room',
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
    public function availableSpaces()
    {
        // Calculate the total number of beds in this room
        $totalBeds = $this->num_of_rooms * $this->num_of_beds_per_room;

        // Sum the number of bookings for this room where status is 'Approved'
        $bookedBeds = Booking::where('room_id', $this->id)
                             ->where('status', 'Approved')
                             ->count();

        // Return available spaces
        return $totalBeds - $bookedBeds;
    }

    public function nextAvailableDate()
    {
        // Get the latest booking for this room where status is 'Approved'
        $latestBooking = Booking::where('room_id', $this->id)
                                ->where('status', 'Approved')
                                ->orderBy('check_out_date', 'desc')
                                ->first();

        // Return the check-out date of the latest booking, or null if no bookings
        return $latestBooking ? $latestBooking->check_out_date : null;
    }
}
