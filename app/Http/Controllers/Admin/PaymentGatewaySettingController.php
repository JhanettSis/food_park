<?php

namespace App\Http\Controllers\Admin;

use App\Events\OrderPaymentUpdateEvent;
use App\Events\OrderPlacedNotificationEvent;
use App\Events\RTOrderPlacedNotificationEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentGatewaySetting;
use App\Services\OrderService;
use App\Services\PaymentGatewaySettingService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Razorpay\Api\Api as RazorpayApi ;

class PaymentGatewaySettingController extends Controller
{
    use FileUploadTrait;

    /**
     * Show Payment Gateway Settings Index Page
     *
     * - This function retrieves all payment gateway settings from the database.
     * - It then passes them to the view to display on the settings page.
     *
     * @return View
     */
    function index() : View {
        $paymentGateway = PaymentGatewaySetting::pluck('value', 'key');
        return view('admin.payment-setting.index', compact('paymentGateway'));
    }

    /**
     * Update PayPal Payment Gateway Settings
     *
     * - This function validates and updates the PayPal payment gateway settings.
     * - It also handles the PayPal logo upload (if provided) and saves the updated settings.
     * - After updating, it clears the cached settings and displays a success message.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function paypalSettingUpdate(Request $request)  {
        $validatedData = $request->validate([
            'paypal_status' => ['required', 'boolean'],
            'paypal_account_mode' => ['required', 'in:sandbox,live'],
            'paypal_country' => ['required'],
            'paypal_currency' => ['required'],
            'paypal_rate' => ['required', 'numeric'],
            'paypal_api_key' => ['required'],
            'paypal_secret_key' => ['required'],
            'paypal_app_id' => ['required'],
        ]);

        if($request->hasFile('paypal_logo')){
            $request->validate([
                'paypal_logo' => ['nullable', 'image']
            ]);
            $imagePath = $this->uploadImage($request, 'paypal_logo', '/settingImages');

            PaymentGatewaySetting::updateOrCreate(
                ['key' => 'paypal_logo'],
                ['value' => $imagePath]
            );
        }

        foreach($validatedData as $key => $value){
            PaymentGatewaySetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(PaymentGatewaySettingService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Updated Successfully!');
        return redirect()->back();
    }
    /**
     * Update Stripe Payment Gateway Settings
     *
     * - This function validates and updates the Stripe payment gateway settings.
     * - It also handles the Stripe logo upload (if provided) and saves the updated settings.
     * - After updating, it clears the cached settings and displays a success message.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function stripeSettingUpdate(Request $request)  {
        $validatedData = $request->validate([
            'stripe_status' => ['required', 'boolean'],
            'stripe_country' => ['required'],
            'stripe_currency' => ['required'],
            'stripe_rate' => ['required', 'numeric'],
            'stripe_api_key' => ['required'],
            'stripe_secret_key' => ['required'],
        ]);

        if($request->hasFile('stripe_logo')){
            $request->validate([
                'paypal_logo' => ['nullable', 'image']
            ]);

            $imagePath = $this->uploadImage($request, 'stripe_logo', '/settingImages');

            PaymentGatewaySetting::updateOrCreate(
                ['key' => 'stripe_logo'],
                ['value' => $imagePath]
            );
        }

        foreach($validatedData as $key => $value){
            PaymentGatewaySetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(PaymentGatewaySettingService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Updated Successfully!');
        return redirect()->back();
    }

    /**
     * Cancel Stripe Payment and Redirect
     *
     * - This function handles the cancel action for Stripe payments.
     * - It redirects the user to the payment cancel route.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    function stripeCancel() {
        $this->transactionFailUpdateStatus('Stripe');
        return redirect()->route('payment.cancel');
    }

    /**
     * Update Razorpay Payment Gateway Settings
     *
     * - This function validates and updates the Razorpay payment gateway settings.
     * - It also handles the Razorpay logo upload (if provided) and saves the updated settings.
     * - After updating, it clears the cached settings and displays a success message.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function razorpaySettingUpdate(Request $request) {
        $validatedData = $request->validate([
            'razorpay_status' => ['required', 'boolean'],
            'razorpay_country' => ['required'],
            'razorpay_currency' => ['required'],
            'razorpay_rate' => ['required', 'numeric'],
            'razorpay_api_key' => ['required'],
            'razorpay_secret_key' => ['required'],
        ]);

        if($request->hasFile('razorpay_logo')){
            $request->validate([
                'razorpay_logo' => ['nullable', 'image']
            ]);

            $imagePath = $this->uploadImage($request, 'razorpay_logo', '/settingImages');

            PaymentGatewaySetting::updateOrCreate(
                ['key' => 'razorpay_logo'],
                ['value' => $imagePath]
            );
        }

        foreach($validatedData as $key => $value){
            PaymentGatewaySetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(PaymentGatewaySettingService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Updated Successfully!');
        return redirect()->back();
    }

    /**
     * Display Razorpay Redirect Page
     *
     * - This function loads the view for the Razorpay redirection page.
     * - It is used during the Razorpay payment process before completing the transaction.
     *
     * @return View
     */
    function razorpayRedirect() {
        return view('frontend.pages.razorpay-redirect');
    }

    /**
     * Handle Payment with Razorpay
     *
     * - This function processes the Razorpay payment by capturing the payment ID.
     * - It checks the payment status and updates the order payment information.
     * - If successful, it dispatches relevant events for order and payment status updates.
     * - The session data is cleared, and the user is redirected to the payment success route.
     *
     * @param Request $request
     * @param OrderService $orderService
     * @return \Illuminate\Http\RedirectResponse
     */
    function payWithRazorpay(Request $request, OrderService $orderService) {
        $api = new RazorpayApi(
            config('gatewaySettings.razorpay_api_key'),
            config('gatewaySettings.razorpay_secret_key'),
        );

        if($request->has('razorpay_payment_id') && $request->filled('razorpay_payment_id')){
            $grandTotal = session()->get('grand_total');
            $payableAmount = ($grandTotal * config('gatewaySettings.razorpay_rate')) * 100;

            try{
                $response = $api->payment
                    ->fetch($request->razorpay_payment_id)
                    ->capture(['amount' => $payableAmount]);
            }catch(\Exception $e) {
                logger($e);
                $this->transactionFailUpdateStatus('Razorpay');
                return redirect()->route('payment.cancel')->withErrors($e->getMessage());
            }

            if($response['status'] === 'captured'){

                $orderId = session()->get('order_id');
                $paymentInfo = [
                    'transaction_id' => $response->id,
                    'currency' => config('settings.site_default_currency'),
                    'status' => 'completed'
                ];

                OrderPaymentUpdateEvent::dispatch($orderId, $paymentInfo, 'Razorpay');
                OrderPlacedNotificationEvent::dispatch($orderId);
                RTOrderPlacedNotificationEvent::dispatch(Order::find($orderId));

                /** Clear session data */
                $orderService->clearSession();

                return redirect()->route('payment.success');
            }else {
                $this->transactionFailUpdateStatus('Razorpay');
                return redirect()->route('payment.cancel')->withErrors('Something went wrong!');
            }
        }
    }

    function transactionFailUpdateStatus($gatewayName) : void {
        $orderId = session()->get('order_id');
        $paymentInfo = [
            'transaction_id' => '',
            'currency' => '',
            'status' => 'Failed'
        ];

        OrderPaymentUpdateEvent::dispatch($orderId, $paymentInfo, $gatewayName);
    }

}
