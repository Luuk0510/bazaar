<?php

namespace Tests\Unit\Models;

use App\Models\Color;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ColorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_is_fillable()
    {
        $color = new Color([
            'name' => 'Blue',
            'light' => '#33A1FD',
            'dark' => '#005F9E',
        ]);

        $this->assertEquals('Blue', $color->name);
        $this->assertEquals('#33A1FD', $color->light);
        $this->assertEquals('#005F9E', $color->dark);
    }


}
