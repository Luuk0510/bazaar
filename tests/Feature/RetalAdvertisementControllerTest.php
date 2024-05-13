<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\Category;
use App\Models\RentalAdvertisement;
use Tests\TestCase;

class RetalAdvertisementControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_show_user_rental_advertisements()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('rental-advertisements.index'));

        $response->assertStatus(200);
        $response->assertViewIs('rental_advertisements.rental_advertisements');

    }


    public function test_display_the_create_rental_advertisement_form()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('rental-advertisements.create'));

        $response->assertStatus(200);
        $response->assertViewIs('rental_advertisements.create_rental_advertisement');

        $response->assertViewHas('categories');
    }


    public function test_show_details_for_a_specific_rental_advertisement()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $rentalAdvertisement = RentalAdvertisement::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('rental-advertisements.showBySlug', $rentalAdvertisement->slug));

        $response->assertStatus(200);
        $response->assertViewIs('rental_advertisements.rental_advertisement');
        $response->assertViewHas('rentalAdvertisement', function ($viewRentalAdvertisement) use ($rentalAdvertisement) {
            return $viewRentalAdvertisement->id === $rentalAdvertisement->id;
        });
    }
}
