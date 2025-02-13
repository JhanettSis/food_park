<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\Address;
use App\Models\BannerSlider;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Category;
use App\Models\Chef;
use App\Models\Contact;
use App\Models\Counter;
use App\Models\OptionProduct;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\Slider;
use App\Models\User;
use App\Models\DeliveryArea;
use App\Models\WhyChooseUs;
use App\Models\Coupon;
use App\Models\DailyOffer;
use App\Models\ProductRating;
use App\Models\ReservationTime;
use App\Models\SocialLink;
use App\Models\Testimonial;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Another way to call the model ->> \App\Models\Slider::factory(4)->create();

        // $this->call(UserSeeder::class); //This seeder is runig on the file Admin/ClearDatabaseControllerb
        // $this->call(SectionTitleSeeder::class);//This seeder is runig on the file Admin/ClearDatabaseControllerb
        // $this->call(SettingSeeder::class); //This seeder is runig on the file Admin/ClearDatabaseControllerb
        // $this->call(MenuContentSeeder::class); //This seeder is runig on the file Admin/ClearDatabaseControllerb
        User::factory(30)->create();
        Slider::factory(5)->create();
        $this->call(WhyChooseUsTitleSeeder::class);
        WhyChooseUs::factory(3)->create();
        $this->call(CategorySeeder::class);

        Product::factory(30)->create()->each(function ($product) {
            ProductGallery::factory(5)->create(['product_id' => $product->id]);
            ProductSize::factory(4)->create(['product_id' => $product->id]);
            OptionProduct::factory(6)->create(['product_id' => $product->id]);
        });

        Coupon::factory(8)->create();
        DeliveryArea::factory(8)->create();
        DailyOffer::factory(20)->create();
        Address::factory(14)->create();
        BannerSlider::factory(4)->create();

        Chef::factory(15)->create();
        $this->call(AppDownloadSectionSeeder::class);
        Testimonial::factory(15)->create();
        Counter::factory(1)->create();
        About::factory(1)->create();
        Contact::factory(1)->create();
        ReservationTime::factory(5)->create();
        SocialLink::factory(4)->create();
        BlogCategory::factory(8)->create();
        Blog::factory(30)->create();
        BlogComment::factory(50)->create();
        ProductRating::factory(200)->create();
    }
}
