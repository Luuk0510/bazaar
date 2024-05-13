<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterAsPrivateAdvertiserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'Jane Doe')
                    ->type('email', 'jane.doe@example.com')
                    ->type('password', 'Password!1234_#A')
                    ->type('password_confirmation', 'Password!1234_#A')
                    ->radio('choose_role', 'particulier')
                    ->screenshot('registration-particulier-form-filled')
                    ->press('REGISTREREN')//__('auth.register.already_registered')
                    ->assertPathIs('/dashboard')
                    ->screenshot('register-particulier-success');
        });
    }
}
