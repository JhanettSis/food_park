<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SectionTitle;
use App\Models\Slider;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FrontendController extends Controller
{

    function index() : View {
        $sectionTitles = $this->getSectionTitle();

        $sliders = Slider::where('status', 1)->get();

        $whyChooseUs = WhyChooseUs::where('status', 1)->get();

        return view('frontend.home.index', compact('sliders', 'sectionTitles', 'whyChooseUs'));
    }

    function getSectionTitle() : Collection{
        $keys = ['why_choose_us_top_title',
        'why_choose_us_main_title',
        'why_choose_us_sub_title'];
        return SectionTitle::whereIn('key', $keys)->pluck('value', 'key'); //['key' => 'value']

    }

}
