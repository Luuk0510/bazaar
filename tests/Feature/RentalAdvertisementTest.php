<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\LandingPage;
use App\Models\Rental;
use App\Models\RentalAdvertisement;
use App\Models\RentalReview;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RentalAdvertisementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $rentalAdvertisement = RentalAdvertisement::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $rentalAdvertisement->user);
        $this->assertEquals($user->id, $rentalAdvertisement->user->id);
    }

    /** @test */
    public function it_belongs_to_a_category()
    {
        $category = Category::factory()->create();
        $rentalAdvertisement = RentalAdvertisement::factory()->create(['category_id' => $category->id]);

        $this->assertInstanceOf(Category::class, $rentalAdvertisement->category);
        $this->assertEquals($category->id, $rentalAdvertisement->category->id);
    }

   
}
