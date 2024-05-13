<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\RentalAdvertisement;


class RentalAdvertisementFactory extends Factory
{
    protected $model = RentalAdvertisement::class;

    public function definition(): array
    {
        $imagePath = public_path('images/50.png');
        $imageContent = File::get($imagePath);
        $imageData = base64_encode($imageContent);
        
        return [
            'user_id' => \App\Models\User::factory(),
            'category_id' => \App\Models\Category::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'slug' => Str::slug($this->faker->sentence),
            'excerpt' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(1, 10, 500),
            'image' => $imageData,
        ];
    }
}
