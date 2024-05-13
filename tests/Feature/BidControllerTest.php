<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Advertisement;
use Tests\TestCase;

class BidControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_can_create_a_bid_for_an_advertisement()
    {
        $user = User::factory()->create();
        $advertisement = Advertisement::factory()->create();

        $this->actingAs($user);

        $bidData = [
            'advertisement_id' => $advertisement->id,
            'amount' => 100, 
        ];

        $response = $this->post(route('bids.store'), $bidData);

        $response->assertRedirect();
        $this->assertDatabaseHas('bids', [
            'user_id' => $user->id,
            'advertisement_id' => $advertisement->id,
            'amount' => $bidData['amount'],
        ]);
        $response->assertSessionHas('success', __('messages.bid_created'));
    }

    /** @test */
    public function test_bid_creation_fails_without_required_fields()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('bids.store'), []);

        $response->assertSessionHasErrors(['amount', 'advertisement_id']);
    }
}
