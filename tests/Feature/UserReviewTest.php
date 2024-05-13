<?php

namespace Tests\Unit\Models;

use App\Models\RentalAdvertisement;
use App\Models\RentalReview;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RentalReviewTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_reviewer()
    {
        $reviewer = User::factory()->create();
        $rentalReview = RentalReview::factory()->create(['reviewer_id' => $reviewer->id]);

        $this->assertInstanceOf(User::class, $rentalReview->reviewer);
        $this->assertEquals($reviewer->id, $rentalReview->reviewer->id);
    }

    /** @test */
    public function it_belongs_to_a_rental_advertisement()
    {
        $rentalAdvertisement = RentalAdvertisement::factory()->create();
        $rentalReview = RentalReview::factory()->create(['rental_advertisement_id' => $rentalAdvertisement->id]);

        $this->assertInstanceOf(RentalAdvertisement::class, $rentalReview->rentalAdvertisements);
        $this->assertEquals($rentalAdvertisement->id, $rentalReview->rentalAdvertisements->id);
    }

}
