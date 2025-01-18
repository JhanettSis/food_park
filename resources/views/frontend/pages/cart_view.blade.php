@extends('frontend.layouts.master')
@section('content')
    ==============================--}}
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>cart view</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="#">cart view</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    {{-- =============================
                BREADCRUMB END
            ============================== --}}


    {{-- ============================
                CART VIEW START
            ============================== --}}
    <section class="fp__cart_view mt_125 xs_mt_95 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody class="table-product">
                                    <tr>
                                        <th class="fp__pro_img">
                                            Image
                                        </th>

                                        <th class="fp__pro_name">
                                            details
                                        </th>

                                        <th class="fp__pro_status">
                                            price
                                        </th>

                                        <th class="fp__pro_select">
                                            quantity
                                        </th>

                                        <th class="fp__pro_tk">
                                            total
                                        </th>

                                        <th class="fp__pro_icon">
                                            <a class="clear_all" href="{{ route('cart.destroye') }}">clear all</a>
                                        </th>
                                    </tr>
                                    {{-- On the file cartViewDetailsTable.blade.php
                                    is the dynamic bodyTable --}}
                                    @include('frontend.layouts.ajax_files.cartViewDetailsTable')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list_footer_button">
                        <h6>total cart</h6>
                        <p class="subtotal">sub total <span class="cartSubtotalView" id="cartSubtotalView">{{ cartTotal() }}</span></p>
                        <p>delivery: <span>$00.00</span></p>
                        <p>discount:
                            @if (session()->has('coupon') && session()->get('coupon')['discount'])
                            <span id="discount">{{ session()->get('coupon')['discount'] }}</span>
                            @else
                            <span id="discount">{{ currencyPosition(0) }}</span>
                            @endif
                        </p>
                        <p class="total"><span>total:</span>
                            @if (session()->has('coupon') && session()->get('coupon')['discount'])
                            <span id="final_total">{{ session()->get('coupon')['finalTotal'] }}</span>
                            @else
                            <span id="final_total">{{ cartTotal() }}</span>
                            @endif

                        </p>
                        {{-- This for submit the code coupon for that I used java function called 'Submint-Coupon'
                        This function It can be found on the file layouts/globalScript.blade.php
                        --}}
                        <form id="coupon-form">
                            <input type="text" id="coupon-code" placeholder="Coupon Code">
                            <button type="submit">Apply</button>
                        </form>

                        {{-- This function onclick="removeCoupon()" is on the
                        This function It can be found on the file layouts/globalScript.blade.php  --}}
                        <div class="coupon_cart">
                            @if (session()->has('coupon') && session()->get('coupon')['discount'])
                                <div class="card mt-2">
                                    <div class="m-3">
                                        <span><b>{{ session()->get('coupon')['code'] }}</b></span>
                                        <span>
                                            <button onclick="removeCoupon()"><i class="far fa-times"></i></button>
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <a class="common_btn" href=" #">checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- ============================
                CART VIEW END
            ============================== --}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.increment').on('click', function() {
                let inputField = $(this).siblings('.quantity');
                let currentValue = parseInt(inputField.val());
                let rowId = inputField.data("id");
                // Increase quantity by 1
                let newQty = currentValue + 1;
                cartQuantity(rowId, newQty, function(response) {
                    if (response.status === 'success') {
                        inputField.val(response.qty);
                        // the product_total on the code response.product_total; is coming from the
                        // controller CartController.php  on the function cart_qty_update
                        let productTotal = response.product_total;
                        // Update the h6 with the formatted total
                        inputField.closest("tr") // Ensure to target the correct row
                            .find(".h6ProductTotalCart") // Find the h6 inside the same row
                            .text(productTotal); // Update the text with the formatted product total
                    } else if (response.error === 'error') {
                        inputField.val(response.qty);
                    }


                });
            })
            // Decrement button click handler
            $('.decrement').on('click', function() {
                let inputField = $(this).siblings('.quantity');
                let currentValue = parseInt(inputField.val());
                let rowId = inputField.data("id");
                // Only decrement if quantity is greater than 1
                if (currentValue > 1) {
                    let newQty = currentValue - 1;
                    cartQuantity(rowId, newQty, function(response) {
                        // Update quantity input field
                        inputField.val(response.qty);
                        // the product_total on the code response.product_total; is coming from the
                        // controller CartController.php  on the function cart_qty_update
                        let productTotal = response.product_total;
                        // Update the h6 with the formatted total
                        inputField.closest("tr") // Ensure to target the correct row
                            .find(".h6ProductTotalCart") // Find the h6 inside the same row
                            .text(productTotal); // Update the text with the formatted product total
                    });
                }
            })

            // Function to send the Ajax request
            function cartQuantity(rowId, qty, callback) {
                $.ajax({
                    method: 'post',
                    url: '{{ route("carUpdate.qty") }}',
                    data: {
                        'rowId': rowId,
                        'qty': qty,
                    },
                    beforeSend: function() {
                        showLoader(); // This function shows a loading spinner
                    },
                    success: function(response) {
                        updateSidebarCart(); // This updates the cart UI in the sidebar
                        // Update the subtotal in the main cart view (cart_view.blade.php)
                        $('#cartSubtotalView').text(response.newSubtotalDetailView); // Update the subtotal in cart.php
                        $('#final_total').text(response.newSubtotalDetailView);
                        $('#discount').text(response.discount);
                        // Check for the 'status' in the response and show appropriate message

                        if (response.status === 'success') {
                            toastr.success(response.message); // Show success message
                        } else {
                            toastr.error(response.message.quantity); // Show error message
                        }

                        if (callback && typeof callback === 'function') {
                            callback(response); // Call the callback if provided
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle any error, typically this is from a network issue or server error
                        let errorMessage = xhr.responseJSON.message || 'Something went wrong!';
                        toastr.error(errorMessage); // Show error message from server or default message
                    },
                    complete: function() {
                        hiddeLoader(); // Hide loading spinner after request is complete
                    }
                });
            }
        })
    </script>
@endpush
