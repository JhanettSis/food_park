<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\SectionTitle;
use App\Models\Slider;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View as ViewView;

class FrontendController extends Controller
{

    function index() : View {
        $sectionTitles = $this->getSectionTitle();
        $sliders = Slider::where('status', 1)->get();
        $whyChooseUs = WhyChooseUs::where('status', 1)->get();
        $categories = Category::where(['show_at_home' => 1 ,'status' => 1])->get();
        return view('frontend.home.index',
        compact('sliders', 'sectionTitles', 'whyChooseUs', 'categories'));
    }

    function getSectionTitle() : Collection{
        $keys = ['why_choose_us_top_title',
        'why_choose_us_main_title',
        'why_choose_us_sub_title'];
        return SectionTitle::whereIn('key', $keys)->pluck('value', 'key'); //['key' => 'value']

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

}
