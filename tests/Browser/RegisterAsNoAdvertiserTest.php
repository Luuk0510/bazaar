<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterAsNoAdvertiserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'John Doe')
                    ->type('email', 'john.doe@example.com')
                    ->type('password', 'Password!123_#A')
                    ->type('password_confirmation', 'Password!123_#A')
                    ->screenshot('registration-standaard-form-filled')
                    ->press('REGISTREREN')//__('auth.register.already_registered')
                    ->assertPathIs('/dashboard')
                    ->screenshot('register-standaard-success');
        });
    }
}
