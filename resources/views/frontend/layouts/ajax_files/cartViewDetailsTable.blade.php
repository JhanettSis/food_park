@foreach (Cart::content() as $product)
    <tr>
        <td class="fp__pro_img"><img src="{{ asset($product->options->product_info['image']) }}" alt="product"
                class="img-fluid w-100">
        </td>

        <td class="fp__pro_name">
            <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
            <span>{{ @$product->options->sizeProduct['name'] }}
                {{ @$product->options->sizeProduct['price'] ? '(' . currencyPosition($product->options->sizeProduct['price']) . ')' : '' }}
            </span>
            @foreach ($product->options->optionsProduct as $option)
                <p>{{ $option['name'] }} {{ '(' . currencyPosition($option['price']) . ')' }}</p>
            @endforeach

        </td>

        <td class="fp__pro_status">
            <h6>{{ currencyPosition($product->price) }}</h6>
        </td>
        <td class="fp__pro_select">
            <div class="quentity_btn">
                <button class="btn btn-danger decrement"><i class="fal fa-minus"></i></button>
                <input type="text" class="quantity" data-id="{{ $product->rowId }}" value="{{ $product->qty }}"
                    name="quantity" placeholder="1" readonly>
                <button class="btn btn-success increment"><i class="fal fa-plus"></i></button>
            </div>
        </td>

        <td class="fp__pro_tk">
            {{-- This function productCartViewTotal(); is on the
                                                app/Helpers/global_helper.php, I don't use currencyPosition(); function here
                                                because on the productCartViewTotal() i returned with the currency sybol  --}}
            <h6 class="h6ProductTotalCart">{{ productCartViewTotal($product->rowId) }}</h6>
        </td>

        <td class="fp__pro_icon">
            <span class="del_icon" onclick="removeProductFromSidebar('{{ $product->rowId }}')"><i
                    class="fal fa-times"></i></span>
        </td>
    </tr>
@endforeach

@if (Cart::content()->count() === 0)
    <tr>
        <td colspan="6" class="fp_tableCart">Cart is empty </td>
    </tr>
@endif
