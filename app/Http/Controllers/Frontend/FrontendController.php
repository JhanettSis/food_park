<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\About;
use App\Models\AppDownloadSection;
use App\Models\BannerSlider;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Category;
use App\Models\Chef;
use App\Models\Contact;
use App\Models\Counter;
use App\Models\DailyOffer;
use App\Models\FooterInfo;
use App\Models\PrivacyPolicy;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductRating;
use App\Models\Reservation;
use App\Models\SectionTitle;
use App\Models\Slider;
use App\Models\SocialLink;
use App\Models\Subscriber;
use App\Models\TermsConditions;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View as ViewView;
use Mail;
use Razorpay\Api\Product as ApiProduct;

class FrontendController extends Controller
{
    /**
     * Display the homepage with multiple sections
     * (sliders, categories, testimonials, etc.).
     *
     * @return View
     */
    function index() : View {
        /**
         * The function getSectionTitle() is create in the same file
         * Get the section titles for various sections
        */
        $sectionTitles = $this->getSectionTitle();
        // Fetch necessary data for the homepage
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
                'counter',
                ));
    }
    /**
     * Fetches section titles from the SectionTitle model.
     *
     * @return Collection
     */
    function getSectionTitle() : Collection{
        // Define the keys to search for in the section titles
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
        return SectionTitle::whereIn('key', $keys)->pluck('value', 'key'); //['key' => 'value'] Return key-value pairs of section titles

    }
    /**
     * Display the chefs page with all chefs.
     *
     * @return View
     */
    function chef() : View {
        $chefs = Chef::where(['status' => 1])->paginate(12); // Fetch and paginate chefs
        return view('frontend.pages.chefs', compact('chefs'));
    }

    /**
     * Display the food menu page with all categories.
     *
     * @return View
     */
    function menu_food() : View {
        $categories = Category::where(['status' => true])->get(); // Fetch food categories
        return view('frontend.pages.menu_food', compact('categories'));
    }
    /**
     * Display the testimonials page.
     *
     * @return View
     */
    function testimonial() : View {
        $testimonials = Testimonial::where(['status' => 1])->paginate(9); // Fetch testimonials with pagination
        return view('frontend.pages.testimonial', compact('testimonials'));
    }

    function allProducts(Request $request) : View {

        $products = Product::where(['status' => true])->orderBy('id', 'DESC');

        if($request->has('search') && $request->filled('search')) {
            $products->where(function($query) use ($request) {
                $query->where('product_name', 'like', $request->search.'%');
            });
        }

        if($request->has('category') && $request->filled('category')) {
            $products->whereHas('category', function($query) use ($request){
                $query->where('slug', $request->category);
            });
        }

        $products = $products->withAvg('reviews', 'rating')->withCount('reviews')->paginate(12);

        $categories = Category::where('status', true)->get();

        return view('frontend.pages.product', compact('products', 'categories'));
    }
    /**
     * Display a single product's details.
     *
     * @param string $slug
     * @return View
     */
    function showProduct(string $slug) : View {
        // Fetch product by slug, or fail if not found
        // This porcion 'firstOrFail' is in case the user can put somename on the url site
        // that isn't exist on the database
        $product = Product::with('galleryProduct', 'sizeProduct', 'OptionProduct')
        ->where(['slug'=> $slug, 'status' => true])->firstOrFail();
        // Fetch related products
        $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->category_id)
        ->where('status', true)
        ->take(8)->latest()->get();

        foreach($relatedProducts as $relatedProduct){
            $relatedProduct->rating_start = $relatedProduct->getAverageRating();
            //dd($relatedProduct . $relatedProduct->rating_start);
        }

        $reviews = ProductRating::where(['product_id' => $product->id, 'status' => true])
        ->paginate(30);

        $total_start_rating = 0;
        foreach($reviews as $review ){
            $total_start_rating += $review->rating;
        }
        $rating_start = $total_start_rating / count($reviews);
        return view('frontend.pages.productView', compact('product', 'relatedProducts', 'reviews', 'rating_start'));
    }


    function productReviewStore(Request $request) {

        $request->validate([
            'rating' => ['required', 'min:1', 'max:5', 'integer'],
            'review' => ['required', 'max:500'],
            'product_id' => ['required', 'integer']
        ]);

        $user = Auth::user();

        $hasPurchased = $user->orders()->whereHas('orderItems', function($query) use ($request){
            $query->where('product_id', $request->product_id);
        })
        ->where('order_status', 'delivered')
        ->get();

        if(count($hasPurchased) == 0){
            throw ValidationException::withMessages(['Please Buy The Product Before Submit a Review!']);
        }

        $alreadyReviewed = ProductRating::where(['user_id' => $user->id, 'product_id' => $request->product_id])->exists();
        if($alreadyReviewed){
            throw ValidationException::withMessages(['You already reviewed this product']);
        }

        $review = new ProductRating();
        $review->user_id = $user->id;
        $review->product_id = $request->product_id;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->status = 0;
        $review->save();

        toastr()->success('Review added successfully and waiting to approve');

        return redirect()->back();
    }

    /**
     * Load a modal with product details using AJAX.
     *
     * @param int $productId
     * @return string
     */
    public function loadProductModal($productId) {
        $product = Product::with(['sizeProduct', 'optionProduct'])->findOrFail($productId);
        return view('frontend.layouts.ajax_files.product_poput', compact('product'))->render();
    }

    /**
     * Display the about page with relevant data.
     *
     * @return View
     */
    function about() : View {
        // Fetch section titles for the about page
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
        $sectionTitles = SectionTitle::whereIn('key', $keys)->pluck('value','key');

        $about = About::first();
        $whyChooseUs = WhyChooseUs::where('status', true)->get();
        $chefs = Chef::where(['show_at_home' => true, 'status' => true])->get();
        $counter = Counter::first();
        $testimonials = Testimonial::where(['show_at_home' => true, 'status' => true])->get();

        return view('frontend.pages.about', compact('about', 'whyChooseUs', 'sectionTitles', 'chefs', 'counter', 'testimonials'));
    }

    /**
     * Display the privacy policy page.
     *
     * @return View
     */
    function privacyPolicy() : View {
        $privacyPolicy = PrivacyPolicy::first();
        return view('frontend.pages.privacy_policy', compact('privacyPolicy'));
    }

    /**
     * Display the terms and conditions page.
     *
     * @return View
     */
    function termsConditions() : View {
        $termsConditions = TermsConditions::first();
        return view('frontend.pages.terms_and_condition', compact('termsConditions'));
    }


    /**
     * Display the contact page.
     *
     * @return View
     */
    function contact() : View {
        $contact = Contact::first();
        return view('frontend.pages.contact', compact('contact'));
    }

    /**
     * Send a contact message via email.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    function sendContactMessage(Request $request) {
        // Validate the contact form data
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'max:255'],
            'message' => ['required', 'max:1000']
        ]);

        // Send the contact message
        Mail::send(new ContactMail($request->name, $request->email, $request->subject, $request->message));
        return response(['status' => 'success', 'message' => 'Message Sent Successfully!']);
    }

    /**
     * Create a reservation request.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws ValidationException
     */
    function reservation(Request $request) {
        // Validate reservation request data
        $request->validate([
            'name' => ['required', 'max:255'],
            'phone' => ['required', 'max:50'],
            'date' => ['required', 'date'],
            'time' => ['required'],
            'persons' => ['required', 'numeric']
        ]);

        // Check if the user is logged in
        if(!Auth::check()){
            throw ValidationException::withMessages(['Please Login to Request Reservation']);
        }
        // Create a new reservation
        $reservation = new Reservation();
        $reservation->reservation_id = rand(0, 500000);
        $reservation->user_id = Auth::user()->id;
        $reservation->name = $request->name;
        $reservation->phone = $request->phone;
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->persons = $request->persons;
        $reservation->status = 'pending';
        $reservation->save();

        return response(['status' => 'success', 'message' => 'Request send successfully']);
    }
    /**
     * Subscribe a user to the newsletter.
     *
     * @param Request $request
     * @return Response
     */
    function subscribeNewsletter(Request $request) : Response {
        // Validate email input for subscription
        $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:subscribers,email']
        ], ['email.unique' => 'Email is already subscribed!']);

        // Save the email in the Subscriber model
        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();

        return response(['status' => 'success', 'message' => 'Subscribed Successfully!']);
    }

    /**
     * Display the blog page with filtering and search options.
     *
     * @param Request $request
     * @return View
     */
    function blog(Request $request) : View {
        // Initialize the blog query
        $blogs = Blog::withCount(['comments'=> function($query){
            $query->where('status', true); // Count only approved comments
        }])->with(['category', 'user'])->where('status', true);

        // Apply search filter if provided
        if($request->has('search') && $request->filled('search')){
            $blogs->where(function($query) use ($request) {
                $query->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }

        // Apply category filter if provided
        if($request->has('category') && $request->filled('category')) {
            $blogs->whereHas('category', function($query) use ($request){
                $query->where('slug', $request->category);
            });
        }

        $blogs = $blogs->latest()->paginate(9); // Paginate the results
        $categories = BlogCategory::where('status', true)->get(); // Fetch categories
        return view('frontend.pages.blog', compact('blogs', 'categories'));
    }

    /**
     * Display a single blog's details.
     *
     * @param string $slug
     * @return View
     */
    function blogDetails(string $slug) : View {
        // Fetch the blog by slug
        $blog = Blog::with(['user'])->where('slug', $slug)->where('status', true)->firstOrFail();
        $comments = $blog->comments()->where('status', true)->orderBy('id', 'DESC')->paginate(20);

        // Fetch the latest blogs and related information
        $latestBlogs = Blog::select('id', 'title', 'slug', 'created_at', 'image')
            ->where('status', true)
            ->where('id', '!=', $blog->id)
            ->latest()->take(5)->get();

        $categories = BlogCategory::withCount(['blogs' => function($query){
            $query->where('status', true);
        }])->where('status', true)->get();

        // Get the next and previous blog posts
        $nextBlog = Blog::select('id', 'title', 'slug', 'image', 'status')
            ->where('id', '>', $blog->id)
            ->where('status', true)
            ->orderBy('id', 'ASC')->first();

        $previousBlog = Blog::select('id', 'title', 'slug', 'image', 'status')
            ->where('status', true)
            ->where('id', '<', $blog->id)
            ->orderBy('id', 'DESC')->first();

        return view('frontend.pages.blog-details', compact(
            'blog', 'latestBlogs', 'categories', 'nextBlog', 'previousBlog', 'comments'
        ));
    }

    /**
     * Store a blog comment.
     *
     * @param Request $request
     * @param string $blog_id
     * @return RedirectResponse
     */
    function blogCommentStore(Request $request, string $blog_id) : RedirectResponse {
        // Validate the comment input
        $request->validate([
            'comment' => ['required', 'max:500']
        ]);

        // Ensure the blog exists
        Blog::findOrFail($blog_id);

        // If user is authenticated, save the comment
        if(Auth::check()){
            $comment = new BlogComment();
            $comment->blog_id = $blog_id;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;
            $comment->save();
            toastr()->success('Comment submitted successfully and waiting to approve.');
        }
        else {
            toastr()->error('Please sign up first!');
        }

        return redirect()->back(); // Redirect back to the previous page
    }



}
