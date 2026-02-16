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
            'category' => 'fashion',
        ]);

        Product::create([
            'name' => 'Noise Cancelling Headphones',
            'description' => 'Immersive sound experience.',
            'price' => 2499,
            'image_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=500&q=80',
            'stock' => 40,
            'category' => 'electronics',
        ]);

        Product::create([
            'name' => 'Vintage Camera',
            'description' => 'Capture moments in style.',
            'price' => 45000,
            'image_url' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=500&q=80',
            'stock' => 5,
            'category' => 'electronics',
        ]);

        Product::create([
            'name' => 'Running Shoes',
            'description' => 'Comfortable and durable.',
            'price' => 3200,
            'image_url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=500&q=80',
            'stock' => 25,
            'category' => 'fashion',
        ]);

        Product::create([
            'name' => 'Smartphone X',
            'description' => 'Latest technology in your hand.',
            'price' => 69999,
            'image_url' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=500&q=80',
            'stock' => 100,
            'category' => 'mobile',
        ]);

        Product::create([
            'name' => 'Matte Lipstick',
            'description' => 'Long lasting color.',
            'price' => 599,
            'image_url' => 'https://images.unsplash.com/photo-1586495777744-4413f21062fa?auto=format&fit=crop&w=500&q=80',
            'stock' => 200,
            'category' => 'beauty',
        ]);

        Product::create([
            'name' => 'Modern Sofa',
            'description' => 'Comfortable 3-seater sofa.',
            'price' => 25000,
            'image_url' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=500&q=80',
            'stock' => 10,
            'category' => 'furniture',
        ]);

        Product::create([
            'name' => 'Teddy Bear',
            'description' => 'Soft and cuddly.',
            'price' => 999,
            'image_url' => 'https://images.unsplash.com/photo-1559454403-b8fb02f86442?auto=format&fit=crop&w=500&q=80',
            'stock' => 30,
            'category' => 'toys',
        ]);

        Product::create([
            'name' => 'Baby Carrier',
            'description' => 'Safe and comfortable for your baby.',
            'price' => 3500,
            'image_url' => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?auto=format&fit=crop&w=500&q=80',
            'stock' => 15,
            'category' => 'baby',
        ]);

        Product::create([
            'name' => 'Kitchen Blender',
            'description' => 'High speed blender for smoothies.',
            'price' => 4200,
            'image_url' => 'https://images.unsplash.com/photo-1570222094114-28a9d8896b74?auto=format&fit=crop&w=500&q=80',
            'stock' => 20,
            'category' => 'appliances',
        ]);

        Product::create([
            'name' => 'Table Lamp',
            'description' => 'Minimalist design lamp.',
            'price' => 1500,
            'image_url' => 'https://images.unsplash.com/photo-1507473888900-52e1adad54cd?auto=format&fit=crop&w=500&q=80',
            'stock' => 45,
            'category' => 'home',
        ]);

        Product::create([
            'name' => 'Cricket Bat',
            'description' => 'Professional grade willow bat.',
            'price' => 3500,
            'image_url' => 'https://images.unsplash.com/photo-1531415074968-0552f5071661?auto=format&fit=crop&w=500&q=80',
            'stock' => 10,
            'category' => 'sports',
        ]);

        Product::create([
            'name' => 'Bestseller Novel',
            'description' => 'A gripping thriller story.',
            'price' => 499,
            'image_url' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=500&q=80',
            'stock' => 100,
            'category' => 'books',
        ]);
    }
}
