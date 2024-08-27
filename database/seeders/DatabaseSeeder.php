<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@mailinator.com',
            'password' => 'password2024'
        ]);

        User::create([
            'name' => 'Budi',
            'role' => 'user',
            'email' => 'budi@mailinator.com',
            'password' => 'password2024'
        ]);

        $this->call(ProductSeeder::class);
    }
}
