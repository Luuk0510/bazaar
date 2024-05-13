<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Advertisement;

class AdvertisementFactory extends Factory
{
    protected $model = Advertisement::class;

    public function definition()
    {
        $imagePath = public_path('images/50.png');
        $imageContent = File::get($imagePath);
        $imageData = base64_encode($imageContent);
        
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'slug' => Str::slug($this->faker->sentence),
            'excerpt' => $this->faker->sentence,
            'category_id' => \App\Models\Category::factory(),
            'user_id' => \App\Models\User::factory(),
            'expire_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'image' => $imageData,
        ];
    }
}
