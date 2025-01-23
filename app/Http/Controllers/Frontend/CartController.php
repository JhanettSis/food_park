<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

use Cart;

class CartController extends Controller
{
    function index() : View {
        return view('frontend.pages.cart_view');
    }

    // Add product in to cart
    function addToCart(Request $request){
        session()->forget('coupon');
        // Find the product based on the provided product_id from the request.
            // The product includes its associated size and option details.
            $product = Product::with(['sizeProduct', 'optionProduct'])->findOrFail($request->product_id);
            if($product->quantity < $request->quantity){
                throw ValidationException::withMessages(['Quantity is not available!']);
            }
        try{
            // The $request->size_product comes from the view input element with name="size_product"
            // Here, we fetch the specific size of the product based on the size id provided in the request.
            $arraysizeProduct = $product->sizeProduct->where('id', $request->size_product)->first();

            // Fetch all the selected product options based on the option ids from the request.
            // The $request->option_product is an array of selected option ids from the view.
            $arrayoptionsProduct = $product->optionProduct->whereIn('id', $request->option_product);

            // Initialize an array that will hold the selected size and options product information.
            // The 'sizeProduct' key holds the size details (id, name, price).
            $arrayoptions = [
                'sizeProduct' => [],
                'optionsProduct' => [], // This will be filled with the selected options products (id, name, price).
                'product_info' => [
                    'image' => $product->product_image,
                    'slug' => $product->slug,
                ]
            ];

            if($arraysizeProduct != null){
                $arrayoptions['sizeProduct'] = [
                    'id' => $arraysizeProduct?->id,           // The size id of the selected size.
                    'name' => $arraysizeProduct?->size_name,  // The size name of the selected size.
                    'price' => $arraysizeProduct?->price,     // The price of the selected size.

                ];
            }
            // Iterate through each selected option product to populate the 'optionsProduct' array with relevant details.
            foreach($arrayoptionsProduct as $arrayoption){
                $arrayoptions['optionsProduct'][] = [
                    'id' => $arrayoption->id,                // The id of the selected option product.
                    'name' => $arrayoption->option_name,      // The name of the selected option product.
                    'price' => $arrayoption->price,           // The price of the selected option product.
                ];
            }

            // Dump the $arrayoptions array to the screen and stop further execution.
            // This is used for debugging to check the selected size and options data.
            //dd($arrayoptions);

            Cart::add([
                'id' => $product->id,
                'name' => $product->product_name,
                'qty' => $request->quantity,
                'price' => $product->offer_price > 0 ? $product->offer_price: $product->price,
                'weight' => 0,
                'options' => $arrayoptions,
            ]);
            return response(['status' => 'success', 'message' => 'Product added into the cart!'], 200);
        }catch(\Exception $e){
            return response(['status' => 'error', 'message' => 'Something went wrong!'], 500);
        }
    }

    function getCartProduct() {
        // Using Cart::content() to get the current cart content
        $cartItems = Cart::content();
        $cartHtml = view('frontend.layouts.ajax_files.sidebarCartItem', compact('cartItems'))->render(); // Return HTML for the cart items

        // Calculate new subtotal
        $newSubtotal = cartTotal();

        $cartCount = count(Cart::content());
        // Return the response
        return response()->json([
            'cartHtml' => $cartHtml,
            'cartCount' => $cartCount,
            /**
             * THis function is on the App/Hepers/global_helper.php
             */
            'newSubtotal' => currencyPosition($newSubtotal), // currencyPosition formats the amount correctly
        ]);
    }

    function cart_product_remove($rowId){
        session()->forget('coupon');
        try{
            Cart::remove($rowId);
             // Using Cart::content() to get the current cart content
            $cartItems = Cart::content();
            // this variable $cartHtml is for the view sidebarCartItem
            $cartHtml = view('frontend.layouts.ajax_files.sidebarCartItem',
            compact('cartItems'))->render(); // Return HTML for the cart items
            // this variable $cartViewDetailsHtml is for the view cart_view
            $cartViewDetailsHtml = view('frontend.layouts.ajax_files.cartViewDetailsTable',
            compact('cartItems'))->render(); // Return HTML for the cart items
            // Calculate new subtotal
            $newSubtotal = cartTotal();

            $cartCount = count(Cart::content());
            // Return the response
            return response()->json([
                'cartHtml' => $cartHtml,
                'cartCount' => $cartCount,
                'cartViewDetailsHtml' => $cartViewDetailsHtml,
                /**
                 * THis function is on the App/Hepers/global_helper.php
                */
                'newSubtotal' => currencyPosition($newSubtotal), // currencyPosition formats the amount correctly
                'discount' => currencyPosition(0)
            ]);
        }catch(\Exception $e){
            return response(['status' => 'error', 'message' => 'Sorry something went wrong!']);
        }
    }

    function cart_qty_update(Request $request): JsonResponse
    {
        session()->forget('coupon');
        try {
            // Get the cart item and the product
            $cartItem = Cart::get($request->rowId);
            $product = Product::findOrFail($cartItem->id);

            // Check if the requested quantity is available
            if ($product->quantity < $request->qty) {
                // If not, throw a validation exception with a custom message
                throw ValidationException::withMessages(['quantity' => 'Quantity is not available!']);
            }
            // Update the cart
            Cart::update($request->rowId, $request->qty);
            // Get the updated product total
            $productTotal = productCartViewTotal($request->rowId); // Assuming this calculates the total
            // Calculate new subtotal
            $newSubtotal = cartTotal();
            // Respond with success if everything goes well
            return response()->json([
                'status' => 'success',
                'message' => 'Product quantity update in the cart!',
                'qty' => $request->qty,
                'product_total' => currencyPosition($productTotal),
                'newSubtotalDetailView' => currencyPosition($newSubtotal),
                'discount' => currencyPosition(0)
            ], 200);
        } catch (ValidationException $e) {
            // Handle validation exception and return the error message in JSON format
            return response()->json([
                'status' => 'error',
                'message' => $e->errors(),  // This will include the 'quantity' validation error
            ], 200);  // 422 Unprocessable Entity is typically used for validation errors
        } catch (\Exception $e) {
            // Log the exception for debugging
            logger($e);

            // Respond with an error if something goes wrong
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please reload the page.',
            ], 500);
        }
    }

    function cart_destroye(){
        session()->forget('coupon');
        Cart::destroy();
        return redirect()->back();
    }

    // handle the request in the controller and send back a response
    function applyCoupon(Request $request)
    {
        session()->forget('coupon');
        $subTotal = cartTotal();
        // Remove commas from the number1 if it's a string and Convert string to float

        $code = $request->coupon_code;

        $coupon = Coupon::where('code', $code)->first();

        if(!$coupon){
            return response(['message' => 'Invalid code!'], 422);
        }
        if($coupon->quantity <= 0){
            return response(['message' => 'Coupon has benn redeemed!'], 422);
        }
        if($coupon->expire_date < now()->format('Y-m-d')){
            return response(['message' => 'Coupon has expired!'], 422);
        }
        if($coupon->status === false){
            return response(['message' => 'Inactive code!'], 422);
        }

        if($coupon->discount_type === 'percentage'){
            $discount = $subTotal * ($coupon->discount/100);

        }

        elseif($coupon->discount_type === 'amount'){
            $discount = $coupon->discount;
        }

        $finalTotal = $subTotal-$discount;
        session()->put('coupon', ['code' => $code,
                'discount' => $discount,
                'finalTotal' => $finalTotal]);

        return response(['message' => 'Coupon Applyed successfully!',
        'code' => $code,
        'discount' => currencyPosition($discount),
        'finalTotal' => currencyPosition($finalTotal)]);
    }

    function destroyeCoupon(){
        session()->forget('coupon');
        $subTotal = cartTotal();
        // Calculate new subtotal
        $newSubtotal = cartTotal();

        return response(['message' => 'Coupon Removed!',
        'discount' => currencyPosition(0),
        'newSubtotal' => currencyPosition($newSubtotal),
        'finalTotal' => currencyPosition($subTotal)]);
    }
}
