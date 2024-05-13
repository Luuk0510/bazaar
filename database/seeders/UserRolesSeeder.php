<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRolesSeeder extends Seeder
{

    public function run(): void
    {
        Role::create(['name' => 'standaard']);
        $particulierRole = Role::create(['name' => 'particulier']);
        $zakelijkRole = Role::create(['name' => 'zakelijk']);
        $adminRole = Role::create(['name' => 'admin']);

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Password123!')
        ]);

        $user->assignRole($adminRole);

        // Particuliere gebruikers aanmaken
        $particulierUsers = User::factory()->count(2)->create()->each(function ($user) use ($particulierRole) {
            $user->assignRole($particulierRole);
        });

        // Zakelijke gebruikers aanmaken
        $zakelijkUsers = User::factory()->count(2)->create()->each(function ($user) use ($zakelijkRole) {
            $user->assignRole($zakelijkRole);
        });
    }
}
