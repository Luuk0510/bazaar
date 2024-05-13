<?php

namespace Tests\Unit\Models;

use App\Models\Advertisement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdvertisementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $advertisement = Advertisement::factory()->create();

        $this->assertInstanceOf(\App\Models\User::class, $advertisement->user);
    }

    /** @test */
    public function it_belongs_to_a_category()
    {
        $advertisement = Advertisement::factory()->create();

        $this->assertInstanceOf(\App\Models\Category::class, $advertisement->category);
    }

    /** @test */
    public function it_has_many_bids()
    {
        $advertisement = Advertisement::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $advertisement->bids);
    }

    // Write more tests as needed...

    /** @test */
    public function it_checks_if_advertisement_is_expired()
    {
        $advertisement = Advertisement::factory()->create([
            'expire_date' => now()->subDay(), // Expired yesterday
        ]);

        $this->assertTrue($advertisement->isExpired());
    }
}
