<script>
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
            url: '{{ route('loadProductModal', ':productId') }}'.replace(':productId', productId),
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
            url: '{{ route('get-cart-products') }}',
            beforeSend: function() {

            },
            success: function(response) {
                // Update the cart content in the sidebar
                $('.cartContent').html(response.cartHtml);
                // Update the cart count products
                $('.cart_count').html(response.cartCount);
                // Update the subtotal value
                $('#cartSubtotal').text(response.newSubtotal); // Update the subtotal

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
            url: '{{ route('cartProductRemove', ':rowId') }}'.replace(":rowId", $rowId),
            beforeSend: function() {
                showLoader();
            },
            success: function(response) {
                // Update the cart content in the sidebar
                $('.cartContent').html(response.cartHtml);
                // Update the cart content in the cartViewDetails is on page/cart_view.blade.php
                $('.table-product').html(response.cartViewDetailsHtml);
                // Update the cart count products
                $('.cart_count').html(response.cartCount);
                // Update the subtotal value
                $('#cartSubtotal').text(response.newSubtotal); // Update the subtotal
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
</script>
