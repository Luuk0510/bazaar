<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalAdvertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'slug', 'excerpt', 'category_id', 'landing_page_id', 'price', 'user_id', 'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function landingPage()
    {
        return $this->belongsTo(LandingPage::class);
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorite_rental_advertisements', 'rental_advertisement_id', 'user_id');
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }


    public function rentalReviews()
    {
        return $this->hasMany(RentalReview::class);
    }

    public function isFavorite(User $user): bool
    {
        return $user->favoriteRentalAdvertisements->contains($this);
    }

    
}
