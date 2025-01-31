<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AppDownloadSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('app_download_sections')->insert([
            'image' => '/uploads/imageDefault.jpg',
            'background' => '/uploads/imageDefault.jpg',
            'title' => $faker->sentence,
            'short_description' => $faker->paragraph,
            'play_store_link' => $faker->url,
            'apple_store_link' => $faker->url,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

}
