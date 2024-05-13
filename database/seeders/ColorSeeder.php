<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('colors')->insert([
            ['name' => 'red', 'light' => '100', 'dark' => '950'],
            ['name' => 'green', 'light' => '100', 'dark' => '950'],
            ['name' => 'blue', 'light' => '100', 'dark' => '950'],
        ]);
    }
}
