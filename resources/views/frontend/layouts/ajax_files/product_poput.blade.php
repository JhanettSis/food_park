<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
    <i class="fal fa-times"></i></button>
<form action="" id="modal_add_to_cart_form">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <div class="fp__cart_popup_img">
        <img src="{{ asset($product->product_image) }}" alt="{{ $product->product_image }}" class="img-fluid w-100">
    </div>
    <div class="fp__cart_popup_text">
        <a href="{{ route('product.show', $product->slug) }}" class="title">{!! $product->product_name !!}</a>
        <p class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
            <span>(201)</span>
        </p>
        <h4 class="price">
            @if ($product->offer_price > 0)
                {{ currencyPosition($product->offer_price) }}
                <input type="hidden" name="base_price" value="{{ $product->offer_price }}">
                <del> {{ currencyPosition($product->price) }}</del>
            @else
                {{ currencyPosition($product->price) }}
                <input type="hidden" name="base_price" value="{{ $product->price }}">
            @endif
        </h4>

        @if ($product->sizeProduct()->exists())
            <div class="details_size">
                <h5>select size</h5>
                @foreach ($product->sizeProduct as $size)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="{{ $size->id }}" name="size_product"
                            id="size-{{ $size->id }}" data-price="{{ $size->price }}">
                        <label class="form-check-label" for="size-{{ $size->id }}">
                            {{ $size->size_name }}<span> + {{ currencyPosition($size->price) }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        @endif
        @if ($product->optionProduct()->exists())
            <div class="details_extra_item">
                <h5>select option <span>(optional)</span></h5>
                @foreach ($product->optionProduct as $option)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $option->id }}"
                            id="option-{{ $option->id }}" data-price="{{ $option->price }}" name="option_product[]">
                        <label class="form-check-label" for="option-{{ $option->id }}">
                            {{ $option->option_name }} <span>+ {{ currencyPosition($option->price) }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="details_quentity">
            <h5>select quentity</h5>
            <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                <div class="quentity_btn">
                    <button class="btn btn-danger decrement"><i class="fal fa-minus"></i></button>
                    <input type="text" class="quantity" value="1" name="quantity" placeholder="1" readonly>
                    <button class="btn btn-success increment"><i class="fal fa-plus"></i></button>
                </div>
                @if ($product->offer_price > 0)
                    <h3 id="total_price"> {{ currencyPosition($product->offer_price) }}</h3>
                @else
                    <h3 id="total_price"> {{ currencyPosition($product->price) }}</h3>
                @endif

            </div>
        </div>
        <ul class="details_button_area d-flex flex-wrap">
            {{-- <li><a class="common_btn" href="#">add to cart</a></li> --}}
            <li><button type="submit" class="common_btn">Add to cart</button></li>
        </ul>
    </div>
</form>
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
        $('#modal_add_to_cart_form').on('submit', function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                method: 'POST',
                url: '{{ route("add-to-cart") }}',
                data: formData,
                success: function(response){

                },
                error: function(xhr, status, error){
                    console.log(error);
                }
            })
        })

    })
</script>