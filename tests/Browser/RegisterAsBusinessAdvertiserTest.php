<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterAsBusinessAdvertiserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'Janed Doe')
                    ->type('email', 'janed.doe@example.com')
                    ->type('password', 'Password!12345_#A')
                    ->type('password_confirmation', 'Password!12345_#A')
                    ->radio('choose_role', 'zakelijk')
                    ->screenshot('registration-business-form-filled')
                    ->press('REGISTREREN')//__('auth.register.already_registered')
                    ->assertPathIs('/dashboard')
                    ->screenshot('register-business-success');
        });
    }
}
