<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\OptionProduct;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\Slider;
use App\Models\User;
use App\Models\WhyChooseUs;
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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserSeeder::class);
        Slider::factory(4)->create();
        //$this->call(WhyChooseUsTitleSeeder ::class);
        WhyChooseUs::factory(3)->create();
        // \App\Models\Slider::factory(4)->create();
        $this->call(CategorySeeder::class);

        Product::factory(30)->create()->each(function ($product) {
            ProductGallery::factory(5)->create(['product_id' => $product->id]);
            ProductSize::factory(4)->create(['product_id' => $product->id]);
            OptionProduct::factory(6)->create(['product_id' => $product->id]);
        });

    }
}
