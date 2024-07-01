<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Hostel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'number',
        'location',
        'description',
        'price',
        'payment_method',
        'payment_number',
        'image',
        'is_verified',
        'user_id',

    ];
    public function rooms()
    {
    return $this->hasMany(Room::class);  
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
    {
        return $this->hasMany(HostelImage::class);
    }
}
