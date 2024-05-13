<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'image',
        'description',
        'color_id',
        'custom_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function rental_advertisements()
    {
        return $this->hasMany(RentalAdvertisement::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

}