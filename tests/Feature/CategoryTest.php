<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Advertisement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_many_advertisements()
    {
        $category = Category::factory()->create();
        $advertisement1 = Advertisement::factory()->create(['category_id' => $category->id]);
        $advertisement2 = Advertisement::factory()->create(['category_id' => $category->id]);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $category->advertisements);
        $this->assertTrue($category->advertisements->contains($advertisement1));
        $this->assertTrue($category->advertisements->contains($advertisement2));
    }

}
