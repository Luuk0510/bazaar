<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'slug', 'excerpt', 'category_id', 'user_id', 'landing_page_id', 'expire_date', 'image', 'bid_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function landingPage()
    {
        return $this->belongsTo(LandingPage::class);
    }

    public function favoriteByUsers()
    {
        return $this->belongsToMany(User::class, 'favorite', 'advertisement_id', 'user_id');
    }

    public function isFavorite(User $user): bool
    {
        return $user->favoriteAdvertisements->contains($this);
    }

    public function isExpired()
    {
        return now()->greaterThanOrEqualTo($this->expire_date);
    }
}
