<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserRolesSeeder::class);
        
        $this->call(CategorySeeder::class);

        $this->call(AdvertisementSeeder::class);

        $this->call(RentalAdvertisementSeeder::class);

        //$this->call(ReviewSeeder::class);
        $this->call(RentalReviewSeeder::class);

        $this->call(UserReviewSeeder::class);

        $this->call(ColorSeeder::class);

    }
}
