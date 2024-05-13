<?php

namespace Tests\Unit\Models;

use App\Models\Advertisement;
use App\Models\Bid;
use App\Models\LandingPage;
use App\Models\Rental;
use App\Models\RentalAdvertisement;
use App\Models\RentalReview;
use App\Models\User;
use App\Models\UserReview;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_many_advertisements()
    {
        $user = User::factory()->create();
        $advertisement1 = Advertisement::factory()->create(['user_id' => $user->id]);
        $advertisement2 = Advertisement::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->advertisements);
        $this->assertTrue($user->advertisements->contains($advertisement1));
        $this->assertTrue($user->advertisements->contains($advertisement2));
    }

    /** @test */
    public function it_has_many_bids()
    {
        $user = User::factory()->create();
        $bid1 = Bid::factory()->create(['user_id' => $user->id]);
        $bid2 = Bid::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->bids);
        $this->assertTrue($user->bids->contains($bid1));
        $this->assertTrue($user->bids->contains($bid2));
    }



    /** @test */
    public function it_has_many_rental_advertisements()
    {
        $user = User::factory()->create();
        $rentalAdvertisement1 = RentalAdvertisement::factory()->create(['user_id' => $user->id]);
        $rentalAdvertisement2 = RentalAdvertisement::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->rentalAdvertisements);
        $this->assertTrue($user->rentalAdvertisements->contains($rentalAdvertisement1));
        $this->assertTrue($user->rentalAdvertisements->contains($rentalAdvertisement2));
    }



    /** @test */
    public function it_belongs_to_many_favorite_advertisements()
    {
        $user = User::factory()->create();
        $advertisement1 = Advertisement::factory()->create();
        $advertisement2 = Advertisement::factory()->create();

        $user->favoriteAdvertisements()->attach([$advertisement1->id, $advertisement2->id]);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->favoriteAdvertisements);
        $this->assertTrue($user->favoriteAdvertisements->contains($advertisement1));
        $this->assertTrue($user->favoriteAdvertisements->contains($advertisement2));
    }

    /** @test */
    public function it_belongs_to_many_favorite_rental_advertisements()
    {
        $user = User::factory()->create();
        $rentalAdvertisement1 = RentalAdvertisement::factory()->create();
        $rentalAdvertisement2 = RentalAdvertisement::factory()->create();

        $user->favoriteRentalAdvertisements()->attach([$rentalAdvertisement1->id, $rentalAdvertisement2->id]);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->favoriteRentalAdvertisements);
        $this->assertTrue($user->favoriteRentalAdvertisements->contains($rentalAdvertisement1));
        $this->assertTrue($user->favoriteRentalAdvertisements->contains($rentalAdvertisement2));
    }
}
