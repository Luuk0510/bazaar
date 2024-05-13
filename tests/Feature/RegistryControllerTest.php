<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Tests\TestCase;

class RegistryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $role = Role::create(['name' => 'zakelijk']);

        $businessUsers = User::factory()->count(5)->create()->each(function ($user) use ($role) {
            $user->assignRole($role);
        });

        $otherUsers = User::factory()->count(3)->create();
    }


    public function test_show_business_registry_page_with_business_users()
    {
        $this->withoutExceptionHandling();
    
        $businessUser = User::role('zakelijk')->first();
        $this->actingAs($businessUser);
    
        $response = $this->get(route('registry.businessoverview'));
    
        $response->assertStatus(200);
        $response->assertViewIs('registry.businessoverview');
        $response->assertViewHas('businessUsers', function ($viewBusinessUsers) {
            return $viewBusinessUsers->count() === 5;
        });
    }
    
}
