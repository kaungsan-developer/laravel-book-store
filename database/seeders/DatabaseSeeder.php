<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use App\Models\Order;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\UserBook;

use App\Models\BookOrder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(20)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'position' => 'owner',
        ]);

        // User::factory()->create([
        //     'name' => 'test',
        //     'email' => 'testing@gmail.com',
        //     'password' => 'admin123',
        //     'position' => 'user',
        // ]);
        // Book::factory()->count(30)->create();
        // Order::factory()->count(30)->create();
        // BookOrder::factory()->count(10)->create();
        // UserBook::factory()->count(10)->create();
        // Category::factory()->count(10)->create();
    }
}
