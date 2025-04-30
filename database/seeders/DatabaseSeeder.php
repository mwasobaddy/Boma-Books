<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Create regular users
        User::factory(5)->create();
        
        // Create featured books
        Book::factory(4)->featured()->create();
        
        // Create regular books
        Book::factory(20)->create();
        
        // Create some out-of-stock books
        Book::factory(3)->outOfStock()->create();
    }
}
