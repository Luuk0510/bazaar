<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class LandingPageEditTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('email', 'admin@gmail.com')->first();

            $browser->loginAs($user)
                    ->visit('/dashboard')
                    ->pause(1000)
                    ->click('div[x-data="{ open: false }"] > div')
                    ->waitFor('div[x-show="open"]', 5)
                    ->clickLink('Landing pagina')
                    ->assertPathIs('/landingpage/admin')
                    ->screenshot('landing-page-view')
                    ->pause(1000)
                    ->clickLink('Landing pagina aanpassen')
                    ->assertPathIs('/landingpage-edit')
                    ->screenshot('landing-page-edit')
                    ->type('company_title_name', 'Mijn Bedrijf')
                    ->type('introduction', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed mollis purus ac pulvinar sollicitudin. Aenean id vestibulum tellus. Nam lobortis pretium mauris. Sed vestibulum sagittis urna, quis lacinia urna facilisis ut. In eleifend molestie justo, viverra tempor sapien pharetra hendrerit. Quisque rhoncus ac nisi eget accumsan. Aenean scelerisque sapien eget ex placerat condimentum. Nulla venenatis quam odio, non accumsan ex ultricies feugiat. Mauris ut rutrum urna. Donec vel luctus est. Curabitur fringilla risus elit, ac placerat augue iaculis quis. Quisque nec ipsum in quam pretium interdum pretium nec odio. Curabitur vestibulum metus in risus hendrerit, nec molestie justo scelerisque. Cras ac sapien nec libero aliquam finibus non ac lectus. Duis venenatis erat mi, aliquam iaculis diam tristique in.')
                    ->radio('color_id', '1')
                    ->screenshot('landing-page-edit-filled')
                    ->press('OPSLAAN')
                    ->screenshot('landing-page-view-filled'); 
        });
    }
}
