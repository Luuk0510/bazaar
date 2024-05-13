<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Advertisement;
use App\Models\RentalAdvertisement;
use Tests\TestCase;

class FavoritesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_all_favorite_advertisements_to_the_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Voeg hier logica toe om enkele advertenties en verhuuradvertenties als favorieten in te stellen voor $user

        $response = $this->get(route('favorites.index'));

        $response->assertStatus(200);
        $response->assertViewIs('favorites.favorites');
    }

    public function test_user_can_toggle_an_advertisement_as_favorite()
    {
        $user = User::factory()->create();
        $advertisement = Advertisement::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('favorites.toggle-advertisement'), ['advertisement_id' => $advertisement->id]);

        $response->assertRedirect();
        $this->assertTrue($user->fresh()->favoriteAdvertisements->contains($advertisement));
        $response->assertSessionHas('success', 'Advertentie is aan favorieten toegevoegd.');
    }

    public function test_user_can_toggle_a_rental_advertisement_as_favorite()
    {
        $user = User::factory()->create();
        $rentalAdvertisement = RentalAdvertisement::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('favorites.toggle-rental-advertisement'), ['rental_advertisement_id' => $rentalAdvertisement->id]);

        $response->assertRedirect();
        $this->assertTrue($user->fresh()->favoriteRentalAdvertisements->contains($rentalAdvertisement));
        $response->assertSessionHas('success', 'Rental is aan favorieten toegevoegd.');
    }
}
