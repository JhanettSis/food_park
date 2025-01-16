@foreach (Cart::content() as $cartContent)
    <li>

        <div class="menu_cart_img">
            <img src="{{ asset($cartContent->options->product_info['image']) }}" alt="menu" class="img-fluid w-100">
        </div>
        <div class="menu_cart_text">
            <a class="title"
                href="{{ route('product.show', $cartContent->options->product_info['slug']) }}">{!! $cartContent->name !!}</a>
            <p class="size">Qty: {{ $cartContent->qty }}</p>
            <p class="size">{{ @$cartContent->options->sizeProduct['name'] }}
                {{ @$cartContent->options->sizeProduct['price'] ? '(' . currencyPosition(
                    @@$cartContent->options->sizeProduct['price']
                ) . ')' : '' }}
            </p>
            @foreach ($cartContent->options->optionsProduct as $cartOptionProduct)
            <span class="extra">{{ $cartOptionProduct['name'] }} ({{ currencyPosition($cartOptionProduct['price']) }})</span>
            @endforeach
            <p class="price">{{ currencyPosition($cartContent->price) }}</p>
        </div>
        <span class="del_icon" onclick="removeProductFromSidebar('{{ $cartContent->rowId }}')"><i class="fal fa-times"></i></span>
    </li>
@endforeach
