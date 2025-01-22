<script>

    /**
     * Show sweet alert confirm message
    */
    $('body').on('click', '.delete-item', function(e) {
        e.preventDefault()
        let urlHref = $(this).attr('href');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'DELETE',
                    //this variable urlHref I declare and put the value before at the top of the script
                    url: urlHref,
                    data: {_token: "{{ csrf_token() }}"},
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            //$('#slider-table').DataTable().draw();
                            //instead the line above this
                            // it's remplasing by the next code
                            window.location.reload();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    },
                })
                /**
                 * Instead of this piece if code from the sweetAlert
                 * I use toastr inside the condition
                 * if(response.status === 'success'){
                 * and I commented the next code -> Swal.fire({
                 */
                // Swal.fire({
                //     title: "Deleted!",
                //     text: "Your file has been deleted.",
                //     icon: "success"
                // });
                    }
        });
    })

    /** Show loader*/
    function showLoader() {
        $('.overlay-container').removeClass('d-none');
        $('.overlay').addClass('active');
    }

    /** Hidde loader */
    function hiddeLoader() {
        $('.overlay').removeClass('active');
        $('.overlay-container').addClass('d-none');
    }

    /** Load Product modal */
    function loadProductModal(productId) {
        $.ajax({
            method: 'GET',
            url: '{{ route("loadProductModal", ":productId") }}'.replace(':productId', productId),
            beforeSend: function() {
                showLoader();
            },
            success: function(response) {
                $('.productModalBody').html(response); // Load the response into the modal body
                $('#cartModal').modal('show'); // Show the modal
            },
            error: function(xhr, status, error) {
                let errorMessage = xhr.responseJSON.Message;
                toastr.error(errorMessage);
            },
            complete: function() {
                hiddeLoader();
            }
        });
    }

    /** Update sidebar Cart */
    function updateSidebarCart() {
        $.ajax({
            method: 'GET',
            url: '{{ route("get-cart-products") }}',
            beforeSend: function() {

            },
            success: function(response) {
                // Update the cart content in the sidebar
                $('.cartContent').html(response.cartHtml);
                // Update the cart count products
                $('.cart_count').html(response.cartCount);
                // Update the subtotal value
                $('#cartSubtotal').text(response.newSubtotal); // Update the subtotal
                $('.coupon_cart').html('');

            },
            error: function(xhr, status, error) {
                console.log(error);
            },
            complete: function() {

            }

        })
    }

    /** Remove cart product from sidebar */
    function removeProductFromSidebar($rowId) {
        $.ajax({
            method: 'GET',
            url: '{{ route("cartProductRemove", ":rowId") }}'.replace(":rowId", $rowId),
            beforeSend: function() {
                showLoader();
            },
            success: function(response) {
                // Update the cart content in the sidebar.php
                $('.cartContent').html(response.cartHtml);
                // Update the cart count products
                $('.cart_count').html(response.cartCount);
                // Update the subtotal value
                $('#cartSubtotal').text(response.newSubtotal); // Update the subtotal

                // Send the data and Update the cart content in the cartViewDetails is on page/cart_view.blade.php
                $('.table-product').html(response.cartViewDetailsHtml);
                $('#cartSubtotalView').text(response.newSubtotal);
                $('#final_total').text(response.newSubtotal);
                $('#discount').text(response.discount);
                $('.coupon_cart').html('');
                toastr.success('Product was removed from the cart!!');
            },
            error: function(xhr, status, error) {
                console.log(error);
            },
            complete: function() {
                hiddeLoader();
            }
        })
    }
    // Name of function 'Submint-Coupon' Handle the form submission using AJAX
    $('#coupon-form').on('submit', function(e) {
        e.preventDefault();  // Prevent the default form submission

        var couponCode = $('#coupon-code').val();  // Get the coupon code

        $.ajax({
            url: '{{ route("applyCoupon") }}',  // Your Laravel route URL
            method: 'POST',
            data: {
                coupon_code: couponCode,  // Sending the coupon code
            },
            beforeSend: function() {
                showLoader();
            },
            success: function(response) {
                console.log(response);
                $('#discount').text(response.discount);
                $('#final_total').text(response.finalTotal);
                $couponCartHtml = `<div class="card mt-2">
                                    <div class="m-3">
                                        <span><b>${response.code}</b></span>
                                        <span>
                                            <button onclick="removeCoupon()"><i class="far fa-times"></i></button>
                                        </span>
                                    </div>
                                </div>`
                $('.coupon_cart').html($couponCartHtml);
                $('#coupon-code').val('');
                toastr.success(response.message);// Display the message
            },
            error: function(xhr, status, error) {
                let errorMessage = xhr.responseJSON.message;
                toastr.error(errorMessage);
            },
            complete: function() {
                hiddeLoader();
            }
        });
    });

    function removeCoupon() {
        $.ajax({
            url: '{{ route("destroye.coupon") }}',
            method: 'GET',
            beforeSend: function() {
                showLoader();
            },
            success: function(response) {
                $('.coupon_cart').html('');
                $('#discount').text(response.discount);
                $('#final_total').text(response.finalTotal);
                toastr.success(response.message);// Display the message
            },
            error: function(xhr, status, error) {
                let errorMessage = xhr.responseJSON.message;
                toastr.error(errorMessage);
            },
            complete: function() {
                hiddeLoader();
            }
        });

    }
</script>
