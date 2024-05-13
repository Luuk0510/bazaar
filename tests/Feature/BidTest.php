<?php

namespace Tests\Unit\Models;

use App\Models\Bid;
use App\Models\User;
use App\Models\Advertisement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BidTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $bid = Bid::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $bid->user);
        $this->assertEquals($user->id, $bid->user->id);
    }

    /** @test */
    public function it_belongs_to_an_advertisement()
    {
        $advertisement = Advertisement::factory()->create();
        $bid = Bid::factory()->create(['advertisement_id' => $advertisement->id]);

        $this->assertInstanceOf(Advertisement::class, $bid->advertisement);
        $this->assertEquals($advertisement->id, $bid->advertisement->id);
    }

    // Write more tests as needed...

    /** @test */
    public function it_can_determine_if_it_is_a_winner_bid()
    {
        $bid = Bid::factory()->create(['is_winner' => true]);

        $this->assertTrue($bid->is_winner);
    }
}
