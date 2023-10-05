<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use App\Models\User;
use Tests\DuskTestCase;
use Illuminate\Support\Str;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginPageView()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertNotPresent('Email')
                ->assertNotPresent('Password')
                ->assertNotPresent('Remember me')
                ->assertNotPresent('Forgot your password?')
                ->assertNotPresent('Log in');
        });
    }
}
