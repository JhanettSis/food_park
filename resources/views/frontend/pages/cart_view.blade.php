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
    {{--=============================
                BREADCRUMB END
            ==============================--}}


    {{--============================
                CART VIEW START
            ==============================--}}
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
                        <p>subtotal: <span>$124.00</span></p>
                        <p>delivery: <span>$00.00</span></p>
                        <p>discount: <span>$10.00</span></p>
                        <p class="total"><span>total:</span> <span>$134.00</span></p>
                        <form>
                            <input type="text" placeholder="Coupon Code">
                            <button type="submit">apply</button>
                        </form>
                        <a class="common_btn" href=" #">checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--============================
                CART VIEW END
            ==============================--}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.increment').on('click', function() {
                let inputField = $(this).siblings('.quantity');
                let currentValue = parseInt(inputField.val());
                let rowId = inputField.data("id");
                inputField.val(currentValue + 1);
                cartQuantity(rowId, inputField.val(), function(response) {
                    // the product_total on the code response.product_total; is coming from the
                    // controller CartController.php  on the function cart_qty_update
                    let productTotal = response.product_total;
                    // Update the h6 with the formatted total
                    inputField.closest("tr") // Ensure to target the correct row
                        .find(".h6ProductTotalCart") // Find the h6 inside the same row
                        .text(productTotal); // Update the text with the formatted product total
                });
            })

            $('.decrement').on('click', function() {
                let inputField = $(this).siblings('.quantity');
                let currentValue = parseInt(inputField.val());
                let rowId = inputField.data("id");
                if (inputField.val() > 1) {
                    inputField.val(currentValue - 1);
                    cartQuantity(rowId, inputField.val(), function(response) {
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

            function cartQuantity(rowId, qty, callback) {
                $.ajax({
                    method: 'post',
                    url: '{{ route('carUpdate.qty') }}',
                    data: {
                        'rowId': rowId,
                        'qty': qty
                    },
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        updateSidebarCart();
                        if (callback && typeof callback === 'function') {
                            callback(response);
                        }

                    },
                    error: function(xhr, status, error) {
                        let errorMessage = xhr.responseJSON.Message;
                        toastr.error(errorMessage);
                    },
                    complete: function() {
                        hiddeLoader();
                    },

                })
            }
        })
    </script>
@endpush
