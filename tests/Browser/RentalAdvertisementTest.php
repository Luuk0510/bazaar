<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\RentalAdvertisement;

class RentalAdvertisementsTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testRentalAdvertisementLinks()
    {
        $rentalAdvertisement = RentalAdvertisement::factory()->create();

        $this->browse(function (Browser $browser) use ($rentalAdvertisement) {
            $browser->visit('/')
                    ->assertSee(__('messages.rental_advertisements'))
                    ->assertVisible('@rental-advertisement-card')
                    ->with('@rental-advertisement-card:first-child', function ($card) use ($rentalAdvertisement) {
                        $card->assertVisible('@advertisement-link')
                             ->assertSeeLink($rentalAdvertisement->title)
                             ->click('@advertisement-link')
                             ->assertPathIs('/rental-advertisements/' . $rentalAdvertisement->slug); 
                    });
        });
    }
}
