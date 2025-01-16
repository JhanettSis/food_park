<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use  Illuminate\Http\Response;

use Cart;

class CartController extends Controller
{
    function index() : View {
        return view('frontend.pages.cart_view');
    }

    // Add product in to cart
    function addToCart(Request $request){
        try{
            // Find the product based on the provided product_id from the request.
            // The product includes its associated size and option details.
            $product = Product::with(['sizeProduct', 'optionProduct'])->findOrFail($request->product_id);

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
            'newSubtotal' => $newSubtotal, // currencyPosition formats the amount correctly
        ]);
    }

    function cart_product_remove($rowId){
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
                'newSubtotal' => $newSubtotal, // currencyPosition formats the amount correctly
            ]);
        }catch(\Exception $e){
            return response(['status' => 'error', 'message' => 'Sorry something went wrong!']);
        }
    }

    function cart_qty_update(Request $request) : Response {
        try{
            Cart::update($request->rowId, $request->qty);
            return response(['product_total' => productCartViewTotal($request->rowId)], 200);
        }catch(\Exception $e){
            logger($e);
            // return response(['status' => 'error', 'message' => $e->getMessage()], 500);
            return response(['status' => 'error', 'message' => 'Something went wrong! Please reload the page'], 500);
        }
    }

    function cart_destroye(){
        Cart::destroy();
        return redirect()->back();
    }
}
