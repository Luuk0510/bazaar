<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        $categories = [
            'Electronics',
            'Clothing & Accessories',
            'Home & Garden',
            'Books & Magazines',
            'Toys & Games',
            'Sporting Goods',
            'Health & Beauty',
            'Cars & Vehicles',
            'Real Estate',
            'Services',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
