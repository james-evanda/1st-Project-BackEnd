<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::first();

        if (!$category) {
            $category = Category::create(['name' => 'Uncategorized']);
        }

        Product::create([
            'category_id' => $category->id,
            'name' => 'Wireless Mouse',
            'price' => 150000,
            'quantity' => 10,
            'photo' => 'mouse.jpg',
        ]);

        Product::create([
            'category_id' => $category->id,
            'name' => 'Gaming Keyboard',
            'price' => 500000,
            'quantity' => 5,
            'photo' => 'keyboard.jpg',
        ]);

        Product::create([
            'category_id' => $category->id,
            'name' => 'Office Chair',
            'price' => 1200000,
            'quantity' => 3,
            'photo' => 'chair.jpg',
        ]);
    }
}
