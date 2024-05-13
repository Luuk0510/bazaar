<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdvertisementTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAdvertisements()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/advertenties') 
                ->assertSee(__('messages.advertisements')) 
                ->assertVisible('.max-w-screen-xl') 
                ->assertPresent('.grid-cols-1') 
                ->assertPresent('.md\:grid-cols-2') 
                ->assertPresent('.lg\:grid-cols-3') 
                ->assertVisible('.advertisement-card'); 

            
        });
    }
}
