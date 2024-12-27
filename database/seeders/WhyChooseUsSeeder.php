<?php

namespace Database\Seeders;

use App\Models\SectionTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhyChooseUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SectionTitle::insert([
            [
                'key' => 'why_choose_us_top_title',
                'value' => 'Top Why Choose Us'
            ],
            [
                'key' => 'why_choose_us_main_title',
                'value' => 'Main Why Choose Us'
            ],
            [
                'key' => 'why_choose_us_sub_title',
                'value' => 'Objectively pontificate quality models before intuitive information. Dramatically recaptiualize multifunctional materials.'
            ]
        ]);
    }
}
