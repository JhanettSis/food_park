<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\About;
use App\Models\AppDownloadSection;
use App\Models\BannerSlider;
use App\Models\Category;
use App\Models\Chef;
use App\Models\Contact;
use App\Models\Counter;
use App\Models\DailyOffer;
use App\Models\PrivacyPolicy;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\SectionTitle;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View as ViewView;
use Mail;

class FrontendController extends Controller
{

    function index() : View {
        /**
         * The function getSectionTitle() is create in the same file
        */
        $sectionTitles = $this->getSectionTitle();
        $sliders = Slider::where('status', true)->get();
        $whyChooseUs = WhyChooseUs::where('status', true)->get();
        $categories = Category::where(['show_at_home' => true ,'status' => true])->get();
        $dailyOffers = DailyOffer::with('product')->where('status', true)->take(15)->get();
        $bannerSliders = BannerSlider::where('status', true)->latest()->take(10)->get();
        $chefs = Chef::where(['show_at_home' => true, 'status' => true])->get();
        $appSection = AppDownloadSection::first();
        $testimonials = Testimonial::where(['show_at_home' => true ,'status' => true])->get();
        $counter = Counter::first();

        return view('frontend.home.index',
        compact('sliders', 'sectionTitles',
                'whyChooseUs', 'categories',
                'bannerSliders',
                'dailyOffers',
                'chefs',
                'appSection',
                'testimonials',
                'counter'
                ));
    }

    function getSectionTitle() : Collection{
        $keys = [
            'why_choose_us_top_title',
            'why_choose_us_main_title',
            'why_choose_us_sub_title',
            'daily_offer_top_title',
            'daily_offer_main_title',
            'daily_offer_sub_title',
            'chef_top_title',
            'chef_main_title',
            'chef_sub_title',
            'testimonial_top_title',
            'testimonial_main_title',
            'testimonial_sub_title'
        ];
        return SectionTitle::whereIn('key', $keys)->pluck('value', 'key'); //['key' => 'value']

    }
    /** Chefs page */
    function chef() : View {
        $chefs = Chef::where(['status' => 1])->paginate(12);
        return view('frontend.pages.chefs', compact('chefs'));
    }

    /** Testimonials page */
    function testimonial() : View {
        $testimonials = Testimonial::where(['status' => 1])->paginate(9);
        return view('frontend.pages.testimonial', compact('testimonials'));
    }
    function showProduct(string $slug) : View {

        // This porcion 'firstOrFail' is in case the user can put some name on the url
        // that is not exist on the database
        $product = Product::with('galleryProduct', 'sizeProduct', 'OptionProduct')
        ->where(['slug'=> $slug, 'status' => '1'])->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->category_id)->take(8)->latest()->get();
        return view('frontend.pages.productView', compact('product', 'relatedProducts'));
    }

    public function loadProductModal($productId)
    {
        $product = Product::with(['sizeProduct', 'optionProduct'])->findOrFail($productId);

        return view('frontend.layouts.ajax_files.product_poput', compact('product'))->render();
    }

    function about() : View {
        $keys = [
            'why_choose_us_top_title',
            'why_choose_us_main_title',
            'why_choose_us_sub_title',
            'chef_top_title',
            'chef_main_title',
            'chef_sub_title',
            'testimonial_top_title',
            'testimonial_main_title',
            'testimonial_sub_title'
        ];

        $sectionTitles = SectionTitle::whereIn('key', $keys)->pluck('value','key');;
        $about = About::first();
        $whyChooseUs = WhyChooseUs::where('status', 1)->get();
        $chefs = Chef::where(['show_at_home' => 1, 'status' => 1])->get();
        $counter = Counter::first();
        $testimonials = Testimonial::where(['show_at_home' => 1, 'status' => 1])->get();

        return view('frontend.pages.about', compact('about', 'whyChooseUs', 'sectionTitles', 'chefs', 'counter', 'testimonials'));
    }

    function privacyPolicy() : View {
        $privacyPolicy = PrivacyPolicy::first();
        return view('frontend.pages.privacy_policy', compact('privacyPolicy'));
    }

    function contact() : View {
        $contact = Contact::first();
        return view('frontend.pages.contact', compact('contact'));
    }

    function sendContactMessage(Request $request) {
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'max:255'],
            'message' => ['required', 'max: 1000']
        ]);


        Mail::send(new ContactMail($request->name, $request->email, $request->subject, $request->message));
        return response(['status' => 'success', 'message' => 'Message Sent Successfully!']);
    }


}
