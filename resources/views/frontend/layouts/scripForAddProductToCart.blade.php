<script>
    $(document).ready(function() {
        $('input[name="size_product"]').on('change', function() {
            updateTotalPrice();
        })

        $('input[name="option_product[]"]').on('change', function() {
            updateTotalPrice();
        })

        /**
         * Start event handle portion for buttons - and +
         */
        // Quantity increment
        $('.increment').on('click', function(e) {
            e.preventDefault();
            let quantityInput = $('.quantity');
            let currentQuantity = parseFloat(quantityInput.val()) || 1; // Default to 1 if empty
            quantityInput.val(currentQuantity + 1);
            updateTotalPrice(); // Recalculate total price on increment
        })

        // Quantity decrement
        $('.decrement').on('click', function(e) {
            e.preventDefault();
            let quantityInput = $('.quantity');
            let currentQuantity = parseFloat(quantityInput.val()) || 1; // Default to 1 if empty
            if (currentQuantity > 1) {
                quantityInput.val(currentQuantity - 1);
                updateTotalPrice(); // Recalculate total price on decrement
            }
        })
        /**
         * End event handle portion for buttons - and +
         */

        /** Function to update the total price base on select options*/
        function updateTotalPrice() {
            let basePrice = parseFloat($('input[name="base_price"]').val());
            let selectedSizePrice = 0;
            let selectedOptionPrice = 0;
            let quantity = parseInt($('.quantity').val()) || 1;
            //calculate the selected prices
            let selectedSize = $('input[name="size_product"]:checked');
            if (selectedSize.length > 0) {
                selectedSizePrice = parseFloat(selectedSize.data("price"));
            }

            //calculate the selected prices
            let selectedOption = $('input[name="option_product[]"]:checked');
            $(selectedOption).each(function() {
                selectedOptionPrice += parseFloat($(this).data("price"));
            })

            // Calculate total price
            let totalPrice = ((basePrice + selectedSizePrice + selectedOptionPrice) * quantity).toFixed(2);
            $('#total_price').text("{{ config('settings.site_currency_icon') }}" + totalPrice)

        }

        //Add to cart function
        $('#modal_add_to_cart_form').on('submit', function(e) {
            e.preventDefault(); // Prevents the default form submission
            let selectedSize = $("input[name='size_product']");
            // Check if size is selected, show toastr error if not
            if (selectedSize.length > 0) {
                if ($("input[name='size_product']:checked").val() === undefined) {
                    toastr.error('Please select a size');
                    console.error('Please select a size');
                    return; // Exit function if no size is selected
                }
            }

            let formData = $(this).serialize(); // Serializes the form data
            $.ajax({
                method: 'POST', // The HTTP method is POST
                url: '{{ route('add-to-cart') }}', // The URL being hit (this will resolve to the route you defined)
                data: formData, // Sends the serialized form data
                beforeSend: function(){
                    $('.modalCartButton').attr('disable', true);
                    $('.modalCartButton').html('<span class="spinner-border spinner-border-sm text-warning" role="status" aria-hidden="true"></span>Loading...')
                },
                success: function(response) {
                    updateSidebarCart();
                    toastr.success(response
                    .message); // Logs the response if the request is successful
                },
                error: function(xhr, status, error) {
                    let errorMessage = xhr.responseJSON.message;
                    toastr.success(errorMessage); // Logs the error if the request fails
                },
                complete: function(){
                    $('.modalCartButton').html('Add to Cart');
                    $('.modalCartButton').attr('disable', false);
                },

            })
        })


    })
</script>
