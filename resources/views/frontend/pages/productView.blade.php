@extends('frontend.layouts.master')

@section('content')
    {{--=============================
        BREADCRUMB START
    ==============================--}}
    <section class="fp__breadcrumb" style="background: url({{ asset(config('settings.breadcrumb')) }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>menu Details</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="javascript:;">menu Details</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    {{--=============================
                            BREADCRUMB END
                        ==============================--}}
    {{--=============================
                            MENU DETAILS START
                        ==============================--}}
    <section class="fp__menu_details mt_115 xs_mt_85 mb_95 xs_mb_65">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-9 wow fadeInUp" data-wow-duration="1s">
                    <div class="exzoom hidden" id="exzoom">
                        <div class="exzoom_img_box fp__menu_details_images">
                            <ul class='exzoom_img_ul'>
                                <li><img class="zoom ing-fluid w-100" src="{{ asset($product->product_image) }}"
                                        alt="product"></li>
                                {{-- It is used for debugging
                                                        purposes to inspect the values of variables
                                                        @ dd($product->galleryProduct) --}}
                                @foreach ($product->galleryProduct as $image)
                                    <li><img class="zoom ing-fluid w-100" src="{{ asset($image->gallery_image) }}"
                                            alt="product"></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="exzoom_nav"></div>
                        <p class="exzoom_btn">
                            <a href="javascript:void(0);" class="exzoom_prev_btn"> <i class="far fa-chevron-left"></i>
                            </a>
                            <a href="javascript:void(0);" class="exzoom_next_btn"> <i class="far fa-chevron-right"></i>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-duration="1s">
                    <form action="" id="modal_add_to_cart_form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="fp__menu_details_text">
                            <h2>{!! $product->product_name !!}</h2>
                            <p class="rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($rating_start >= $i)
                                        <i class="fas fa-star"></i>
                                    @elseif ($rating_start >= $i - 0.5)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                                <span>({{ count($reviews) }})</span>
                            </p>
                            <h3 class="price">
                                @if ($product->offer_price > 0)
                                    {{ currencyPosition($product->offer_price) }}
                                    <input type="hidden" name="base_price" value="{{ $product->offer_price }}">
                                    <del> {{ currencyPosition($product->price) }}</del>
                                @else
                                    {{ currencyPosition($product->price) }}
                                    <input type="hidden" name="base_price" value="{{ $product->price }}">
                                @endif
                            </h3>

                            <p class="short_description">{{ $product->short_description }}</p>

                            @if ($product->sizeProduct()->exists())
                                <div class="details_size">
                                    <h5>select size</h5>
                                    @foreach ($product->sizeProduct as $size)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="{{ $size->id }}"
                                                name="size_product" id="size-{{ $size->id }}"
                                                data-price="{{ $size->price }}">
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
                                                id="option-{{ $option->id }}" data-price="{{ $option->price }}"
                                                name="option_product[]">
                                            <label class="form-check-label" for="option-{{ $option->id }}">
                                                {{ $option->option_name }} <span>+
                                                    {{ currencyPosition($option->price) }}</span>
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
                                @if ($product->quantity <= 0)
                                    <li>
                                        <button type="button" class="common_btn bg-warning">Stock Out</button>
                                    </li>
                                @else
                                    <li>
                                        <button type="submit" class="common_btn modalCartButton">Add to cart</button>
                                    </li>
                                @endif
                                <li><a class="wishlist" href="#"><i class="far fa-heart"></i></a></li>
                            </ul>
                        </div>

                    </form>
                </div>
                <div class="col-12 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__menu_description_area mt_100 xs_mt_70">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false">Reviews</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="menu_det_description">
                                    <p>{{ $product->long_description }}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab" tabindex="0">
                                <div class="fp__review_area">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4>{{ count($reviews) }} reviews</h4>
                                            <div class="fp__comment pt-0 mt_20">
                                                @foreach ($reviews as $review)
                                                <div class="fp__single_comment m-0 border-0">
                                                    <img src="{{asset($review->user->avatar)}}" alt="review" class="img-fluid">
                                                    <div class="fp__single_comm_text">
                                                        <h3>{{ $review->user->name }} <span>{{ date('d m Y', strtotime($review->created_at)) }} </span></h3>
                                                        <span class="rating">
                                                            @for ($i = 1; $i <= $review->rating; $i++)
                                                            <i class="fas fa-star"></i>
                                                            @endfor


                                                        </span>
                                                        <p>{{ $review->review }}</p>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @if ($reviews->hasPages())
                                                <div class="fp__pagination mt_60">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            {{ $reviews->links() }}
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if (count($reviews) === 0)
                                                    <div class="alert alert-warning mt-4">No review found!</div>
                                                @endif
                                            </div>

                                        </div>
                                        @auth
                                        <div class="col-lg-4">
                                            <div class="fp__post_review">
                                                <h4>write a Review</h4>
                                                <form action="{{ route('product-review.store') }}" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-xl-12 mt-3">
                                                            <label> Choose a rating</label>
                                                            <select name="rating" id="rating_input" class="form-control ">
                                                                <option value="5">5</option>
                                                                <option value="4">4</option>
                                                                <option value="3">3</option>
                                                                <option value="2">2</option>
                                                                <option value="1">1</option>
                                                            </select>
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        </div>

                                                        <div class="col-xl-12">
                                                            <label for="">Review</label>
                                                            <textarea style="margin-top: 2px" name="review" rows="3" placeholder="Write your review"></textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <button class="common_btn" type="submit">submit
                                                                review</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-lg-4">
                                            <h4>write a Review</h4>
                                            <div class="alert alert-warning mt-4">Please login first to add review.</div>
                                        </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (count($relatedProducts) > 0)
                <div class="fp__related_menu mt_90 xs_mt_60">
                    <h2>Related item</h2>
                    <div class="row related_product_slider">
                        @foreach ($relatedProducts as $relatedProduct)
                            <div class="col-xl-3 wow fadeInUp" data-wow-duration="1s">
                                <div class="fp__menu_item">
                                    <div class="fp__menu_item_img">
                                        <img src="{{ $relatedProduct->product_image }}" alt="menu"
                                            class="img-fluid w-100">
                                        <a class="category" href="#">{{ @$relatedProduct->category->name }}</a>
                                    </div>
                                    <div class="fp__menu_item_text">
                                        <p class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($relatedProduct->rating_start >= $i)
                                                    <i class="fas fa-star"></i>
                                                @elseif ($relatedProduct->rating_start >= $i - 0.5)
                                                    <i class="fas fa-star-half-alt"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            <span>({{ $relatedProduct->reviews->count() }})</span>
                                        </p>
                                        <a class="title"
                                            href="{{ route('product.show', $relatedProduct->slug) }}">{{ $relatedProduct->product_name }}</a>
                                        <h5 class="price">
                                            @if ($relatedProduct->offer_price > 0)
                                                {{ currencyPosition($relatedProduct->offer_price) }}
                                                <del>{{ currencyPosition($relatedProduct->price) }}</del>
                                            @else
                                                {{ currencyPosition($relatedProduct->price) }}
                                            @endif
                                        </h5>
                                        <ul class="d-flex flex-wrap justify-content-center">
                                            <li>
                                                <a href="javascript:;" onclick="loadProductModal({{ $relatedProduct->id }})">
                                                    <i class="fas fa-shopping-basket"></i>
                                                </a>
                                            </li>
                                            <li><a href="javascript:;" onclick="addToWishlist({{ $relatedProduct->id }})">
                                                <i class="fal fa-heart"></i></a></li>
                                            <li><a href="#"><i class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
    {{--=============================
                            MENU DETAILS END
                        ==============================--}}

@endsection

@push('scripts')
{{-- --------------------------------------------------------
    This script take all values from the input and class and adding
    at the cart controller --}}
    {{-- @include('frontend.layouts.scripForAddProductToCart') --}}
                {{-- ------------------------------------------------------ --}}
    @include('frontend.layouts.scripForAddProductToCart')
@endpush
