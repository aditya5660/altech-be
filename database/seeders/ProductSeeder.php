<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productCategories = [
            'Atasan', 'Bawahan', 'Sepatu', 'Aksesoris'
        ];

        // loop through the product categories
        foreach ($productCategories as $category) {
            // create a new product category
            ProductCategory::create([
                'name' => $category,
                'slug' => Str::slug($category),
                'desc' => "This is a $category category",
                'image' => "$category.jpg",
            ]);
        };

        $products = [
            [
                'category_id' => ProductCategory::where('name', 'Atasan')->first()->id,
                'name' => 'Kemeja Putih',
                'slug' => 'kemeja-putih',
                'image' => 'images/products/kemeja-putih.jpg',
                'price' => 100000,
                'desc' => 'Kemeja putih yang sangat elegan',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => ProductCategory::where('name', 'Atasan')->first()->id,
                'name' => 'Kemeja Hitam',
                'slug' => 'kemeja-hitam',
                'image' => 'images/products/kemeja-hitam.jpg',
                'price' => 100000,
                'desc' => 'Kemeja hitam yang sangat elegan',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => ProductCategory::where('name', 'Bawahan')->first()->id,
                'name' => 'Celana Jeans',
                'slug' => 'celana-jeans',
                'image' => 'images/products/celana-jeans.jpg',
                'price' => 150000,
                'desc' => 'Celana jeans yang sangat nyaman',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => ProductCategory::where('name', 'Bawahan')->first()->id,
                'name' => 'Celana Jogger',
                'slug' => 'celana-jogger',
                'image' => 'images/products/celana-jogger.jpg',
                'price' => 150000,
                'desc' => 'Celana jogger yang sangat nyaman',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => ProductCategory::where('name', 'Sepatu')->first()->id,
                'name' => 'Sneakers Putih',
                'slug' => 'sneakers-putih',
                'image' => 'images/products/sneakers-putih.jpg',
                'price' => 200000,
                'desc' => 'Sneakers putih yang sangat keren',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => ProductCategory::where('name', 'Sepatu')->first()->id,
                'name' => 'Sneakers Hitam',
                'slug' => 'sneakers-hitam',
                'image' => 'images/products/sneakers-hitam.jpg',
                'price' => 200000,
                'desc' => 'Sneakers hitam yang sangat keren',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => ProductCategory::where('name', 'Aksesoris')->first()->id,
                'name' => 'Topi',
                'slug' => 'topi',
                'image' => 'images/products/topi.jpg',
                'price' => 50000,
                'desc' => 'Topi yang sangat keren',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => ProductCategory::where('name', 'Aksesoris')->first()->id,
                'name' => 'Masker',
                'slug' => 'masker',
                'image' => 'images/products/masker.jpg',
                'price' => 25000,
                'desc' => 'Masker yang sangat keren',
                'is_active' => true,
                'is_featured' => true,
            ],
        ];

        // loop through the products
        foreach ($products as $product) {
            // create a new product
            \App\Models\Product::create($product);
        }
    }
}
