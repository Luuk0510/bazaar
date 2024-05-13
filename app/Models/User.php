<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function rentalAdvertisements()
    {
        return $this->hasMany(RentalAdvertisement::class);
    }

    public function landingPage()
    {
        return $this->hasOne(LandingPage::class);
    }

    public function favoriteAdvertisements()
    {
        return $this->belongsToMany(Advertisement::class, 'favorite_advertisements', 'user_id', 'advertisement_id');
    }

    public function favoriteRentalAdvertisements()
    {
        return $this->belongsToMany(RentalAdvertisement::class, 'favorite_rental_advertisements', 'user_id', 'rental_advertisement_id');
    }

    public function rentalReviews() {
        return $this->hasMany(RentalReview::class);
    }

    public function receivedReviews() {
        return $this->hasMany(UserReview::class, 'user_id');
    }

    public function sentReviews() {
        return $this->hasMany(UserReview::class, 'reviewer_id');
    }
}
