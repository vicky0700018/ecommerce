<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Classic Watch',
            'description' => 'Elegant design, verified quality.',
            'price' => 12999,
            'image_url' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=500&q=80',
            'stock' => 50,
        ]);

        Product::create([
            'name' => 'Noise Cancelling Headphones',
            'description' => 'Immersive sound experience.',
            'price' => 2499,
            'image_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=500&q=80',
            'stock' => 40,
        ]);

        Product::create([
            'name' => 'Vintage Camera',
            'description' => 'Capture moments in style.',
            'price' => 45000,
            'image_url' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=500&q=80',
            'stock' => 5,
        ]);

        Product::create([
            'name' => 'Running Shoes',
            'description' => 'Comfortable and durable.',
            'price' => 3200,
            'image_url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=500&q=80',
            'stock' => 25,
        ]);
    }
}
