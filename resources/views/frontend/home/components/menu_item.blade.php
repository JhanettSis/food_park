{{--=============================
        MENU ITEM START
    ==============================--}}
<section class="fp__menu mt_95 xs_mt_65">
    <div class="container">
        <div class="row wow fadeInUp" data-wow-duration="1s">
            <div class="col-md-8 col-lg-7 col-xl-6 m-auto text-center">
                <div class="fp__section_heading mb_45">
                    <h4>food Menu</h4>
                    <h2>Our Popular Delicious Foods</h2>
                    <span>
                        <img src="frontend/images/heading_shapes.png" alt="shapes" class="img-fluid w-100">
                    </span>
                    <p>Objectively pontificate quality models before intuitive information. Dramatically
                        recaptiualize multifunctional materials.</p>
                </div>
            </div>
        </div>

        <div class="row wow fadeInUp" data-wow-duration="1s">
            <div class="col-12">
                <div class="menu_filter d-flex flex-wrap justify-content-center">
                    <button class=" active" data-filter="*">all menu</button>
                    @foreach ($categories as $category)
                        <button data-filter=".{{ $category->slug }}">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row grid">
            @foreach ($categories as $category)
                @php
                    $products = \App\Models\Product::where([
                        'show_at_home' => true,
                        'status' => true,
                        'category_id' => $category->id,
                    ])
                        ->orderBy('id', 'Desc')
                        ->take(8)
                        ->get();

                        foreach($products as $product){
                            $product->rating_start = $product->getAverageRating();
                        }
                @endphp
                @foreach ($products as $product)
                    <div class="col-xl-3 col-sm-6 col-lg-4 {{ $category->slug }} wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__menu_item">
                            <div class="fp__menu_item_img">
                                <img src="{{ $product->product_image }}" alt="menu {{ $product->product_name }}"
                                    class="img-fluid w-100">
                                <a class="category" href="#">{{ @$product->category->name }}</a>
                            </div>
                            <div class="fp__menu_item_text">
                                <p class="rating">
                                    @for ($i = 1; $i<=5; $i++)
                                        @if ($product->rating_start >= $i)
                                            <i class="fas fa-star"></i>
                                        @elseif ($product->rating_start >= $i - 0.5)
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                    <span>({{ $product->reviews->count() }})</span>
                                </p>
                                <a class="title"
                                    href="{{ route('product.show', $product->slug) }}">{{ $product->product_name }}</a>
                                <h5 class="price">
                                    @if ($product->offer_price > 0)
                                    {{-- /**
                                    * THis function is on the App/Hepers/global_helper.php
                                    */ --}}
                                        {{ currencyPosition($product->offer_price) }}
                                        <del> {{ currencyPosition($product->price) }}</del>
                                    @else
                                        {{ currencyPosition($product->price) }}
                                    @endif
                                </h5>
                                <ul class="d-flex flex-wrap justify-content-center">
                                    <li>
                                        {{-- Here this button open a modal view, this modal is on the
                                        layouts/ajax_files/product_poput.blade.php--}}
                                        <a href="javascript:;" onclick="loadProductModal({{ $product->id }})">
                                            <i class="fas fa-shopping-basket"></i>
                                        </a>
                                    </li>
                                    <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach

        </div>
    </div>
</section>
{{--=============================
        MENU ITEM END
    ==============================--}}
