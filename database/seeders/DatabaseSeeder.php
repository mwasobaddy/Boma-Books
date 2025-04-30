<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
        
        // Create predefined categories
        $categories = $this->createCategories();
        
        // Create featured books and assign to random categories
        Book::factory(4)->featured()->make()->each(function ($book) use ($categories) {
            $book->category_id = $categories->random()->id;
            $book->save();
        });
        
        // Create regular books and assign to random categories
        Book::factory(20)->make()->each(function ($book) use ($categories) {
            $book->category_id = $categories->random()->id;
            $book->save();
        });
        
        // Create some out-of-stock books and assign to random categories
        Book::factory(3)->outOfStock()->make()->each(function ($book) use ($categories) {
            $book->category_id = $categories->random()->id;
            $book->save();
        });
    }
    
    /**
     * Create predefined categories for the bookstore.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function createCategories()
    {
        // Create common book categories with predefined slugs for better SEO
        $predefinedCategories = [
            ['name' => 'Fiction', 'order' => 1],
            ['name' => 'Non-Fiction', 'order' => 2],
            ['name' => 'Science Fiction', 'order' => 3],
            ['name' => 'Mystery', 'order' => 4],
            ['name' => 'Fantasy', 'order' => 5],
            ['name' => 'Biography', 'order' => 6],
            ['name' => 'History', 'order' => 7],
            ['name' => 'Self-Help', 'order' => 8],
            ['name' => 'Business', 'order' => 9],
            ['name' => 'Romance', 'order' => 10],
        ];
        
        $categories = collect();
        
        foreach ($predefinedCategories as $cat) {
            $category = Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'description' => 'A collection of ' . strtolower($cat['name']) . ' books for all readers.',
                'is_active' => true,
                'order' => $cat['order'],
            ]);
            
            $categories->push($category);
        }
        
        // Also create a few random categories
        $categories = $categories->merge(Category::factory(3)->active()->create());
        
        return $categories;
    }
}
