<?php
/**
 * For register the new file called admin.php
 * this is for admin route's and separate the routes for normal user and admin
 * I add this file admin.php(routes for admin) on botstrap/app.php file this is new in laravel 11
 */

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AppDownloadSectionController;
use App\Http\Controllers\Admin\BannerSliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\ChefController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\DeliveryAreaController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DailyOfferController;
use App\Http\Controllers\Admin\NewsLetterController;
use App\Http\Controllers\Admin\OptionProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentGatewaySettingController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ReservationTimeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use Illuminate\Support\Facades\Route;

// Route Grouping:

// prefix => 'admin' ensures all routes have /admin in the URL.
// as => 'admin' prefixes route names with admin. (e.g., admin.dashboard).
// Dashboard Route:

// A GET request to /admin/dashboard calls the index method of AdminDashboardController.
// Named admin.dashboard for easy reference.
// Profile Routes:

// A GET request to /admin/profile shows the profile page.
// A PUT request to /admin/profile updates profile details.
// A PUT request to /admin/profile/password handles password updates.
// Route::get('admin/dashboard', [AdminDashboardController ::class, 'index'])
//     ->middleware(['auth', 'role:admin'])  // Ensure you use 'role' middleware with the 'admin' role
//     ->name('admin/dashboard');

// Admin Routes Group - Organizes all admin-related routes under the 'admin' prefix and name

// Group routes with a prefix of 'admin' and named as 'admin' (e.g., admin.dashboard, admin.profile)
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    /**
     * Admin Dashboard Route
     * URL: /admin/dashboard
     * Controller: AdminDashboardController
     * Method: index
     * Name: admin.dashboard
     *
     * This route displays the admin dashboard.
     */
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    /**
     * Admin Profile View Route
     * URL: /admin/profile
     * Controller: AdminProfileController
     * Method: index
     * Name: admin.profile
     *
     * Displays the admin's profile page where profile details can be viewed or edited.
     */
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');

    /**
     * Admin Profile Update Route
     * URL: /admin/profile (PUT)
     * Controller: AdminProfileController
     * Method: updateProfile
     * Name: admin.profile.update
     *
     * Handles profile update requests (e.g., name, email).
     */
    Route::put('/profile', [AdminProfileController::class, 'updateProfile'])->name('profile.update');

    /**
     * Admin Password Update Route
     * URL: /admin/profile/password (PUT)
     * Controller: AdminProfileController
     * Method: updatePassword
     * Name: admin.profile.password.update
     *
     * Handles requests to update the admin's password.
     */
    Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password.update');

    /** Silder route */
    Route::resource('/slider', SliderController::class);

    /** WhyChooseUs section route */
    Route::put('/why_choose_title_update', [WhyChooseUsController::class, 'updateTitle'])->name('why_choose_title.update');
    Route::resource('/why_choose_us', WhyChooseUsController::class);

    /** Route Product Category */
    Route::resource('/categories', CategoryController::class);

    /** Route Product */
    Route::resource('/products', ProductController ::class);

    /** Route Product Gallery */
    Route::get('/product-gallery/{product}', [ProductGalleryController ::class, 'index'])->name('product-gallery.show-index');
    Route::resource('/product-gallery', ProductGalleryController ::class);

    /** Route Product Size */
    Route::get('/product-size/{product}', [ProductSizeController ::class, 'index'])->name('product-size.show-index');
    Route::resource('/product-size', ProductSizeController ::class);

    /** Route Product Size */
    Route::resource('/product-option', OptionProductController::class);

    /** Setting Routes */
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/general-setting', [SettingController::class, 'UpdateGeneralSetting'])->name('general_setting.update');
    Route::put('/pusher-setting', [SettingController::class, 'UpdatePusherSetting'])->name('pusher_setting.update');
    Route::put('/mail-setting', [SettingController::class, 'UpdateMailSetting'])->name('mail_setting.update');
    Route::put('/logo-setting', [SettingController::class, 'UpdateLogoSetting'])->name('logo_setting.update');
    Route::put('/appearance-setting', [SettingController::class, 'UpdateAppearanceSetting'])->name('appearance_setting.update');
    Route::put('/seo-setting', [SettingController::class, 'UpdateSeoSetting'])->name('seo_setting.update');

    /** Coupon Routes  */
    Route::resource('/coupons', CouponController::class);
    /** Deliveries Areas Routes  */
    Route::resource('/delivery_areas', DeliveryAreaController::class);

    /** Order Routes */
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    /** This route is for invoice form orders */
    Route::get('/orders/status/{id}', [OrderController::class, 'getOrderStatus'])->name('orders.status');
    Route::put('/orders/status-update/{id}', [OrderController::class, 'orderStatusUpdate'])->name('orders.status-update');

    /** Routes for Orders status pages, */
    Route::get('/pending-orders', [OrderController::class, 'pendingOrderIndex'])->name('pending-orders');
    Route::get('/inprocess-orders', [OrderController::class, 'inProcessOrderIndex'])->name('inprocess-orders');
    Route::get('/delivered-orders', [OrderController::class, 'deliveredOrderIndex'])->name('delivered-orders');
    Route::get('/declined-orders', [OrderController::class, 'declinedOrderIndex'])->name('declined-orders');


    /** Payment Gateway Setting Routes */
    Route::get('/payment-gateway-setting', [PaymentGatewaySettingController::class, 'index'])->name('payment-setting.index');
    Route::put('/paypal-setting', [PaymentGatewaySettingController::class, 'paypalSettingUpdate'])->name('paypal-setting.update');
    Route::put('/stripe-setting', [PaymentGatewaySettingController::class, 'stripeSettingUpdate'])->name('stripe-setting.update');
    Route::put('/razorpay-setting', [PaymentGatewaySettingController::class, 'razorpaySettingUpdate'])->name('razorpay-setting.update');


    /** Order Notification Routes */
    Route::get('/clear-notification',[AdminDashboardController::class, 'clearNotification'])->name('clear-notification');

    /** chat Routes */
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/get-conversation/{senderId}',[ChatController::class, 'getConversation'])->name('chat.get-conversation');
    Route::post('/chat/send-message', [ChatController::class, 'sendMessage'])->name('chat.send-message');

    /** Daily Offer Routes */
    Route::get('daily-offer/search-product', [DailyOfferController::class, 'productSearch'])->name('daily-offer.search-product');
    Route::put('daily-offer-title-update', [DailyOfferController::class, 'updateTitle'])->name('daily-offer-title-update');
    Route::resource('daily-offer', DailyOfferController::class);

    /** Banner Slider Routes */
    Route::resource('banner_slider', BannerSliderController::class);

    /** Chefs Routes */
    Route::put('chefs-title-update', [ChefController::class, 'updateTitle'])->name('chefs-title-update');
    Route::resource('chefs', ChefController::class);

    /** App Download Routes */
    Route::get('/app-download', [AppDownloadSectionController::class, 'index'])->name('app_download.index');
    Route::post('/app-download', [AppDownloadSectionController::class, 'store'])->name('app_download.store');

    /** Testimonial Routes */
    Route::put('/testimonial-title-update', [TestimonialController::class, 'updateTitle'])->name('testimonial_title-update');
    Route::resource('/testimonials', TestimonialController::class);

    /** Counter Routes */
    Route::get('counter', [CounterController::class, 'index'])->name('counter.index');
    Route::put('counter', [CounterController::class, 'update'])->name('counter.update');

    /** About Routes */
    Route::get('about', [AboutController::class, 'index'])->name('about.index');
    Route::put('about', [AboutController::class, 'update'])->name('about.update');

    /** privacy policy Routes */
    Route::get('privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy_policy.index');
    Route::put('privacy-policy', [PrivacyPolicyController::class, 'update'])->name('privacy_policy.update');

    /** Contact Routes */
    Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
    Route::put('contact', [ContactController::class, 'update'])->name('contact.update');

    /** Reservation Routes */
    Route::resource('reservation-time', ReservationTimeController::class);
    Route::get('reservation', [ReservationController::class, 'index'])->name('reservation.index');
    Route::post('reservation', [ReservationController::class, 'update'])->name('reservation.update');
    Route::delete('reservation/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');

    /** News letter Routes */
    Route::get('news-letter', [NewsLetterController::class, 'index'])->name('news_letter.index');
    Route::post('news-letter', [NewsLetterController::class, 'sendNewsLetter'])->name('news_letter.send');

    /** Social Links Routes */
    Route::resource('social_link', SocialLinkController::class);


});
