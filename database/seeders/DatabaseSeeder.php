<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Copy;
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
        User::factory(10)->create();
<<<<<<< HEAD
        Book::factory(10)->create();
        Copy::factory(10)->create();
        /*User::factory()->create([
=======

        User::factory()->create([
>>>>>>> 496461b98e2c85c218aece720c04c77cb9668b35
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
    }
}
