{{-- =============================
        TOPBAR START
    ============================== --}}
<section class="fp__topbar">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-md-8">
                <ul class="fp__topbar_info d-flex flex-wrap">
                    <li><a href="mailto:example@gmail.com"><i class="fas fa-envelope"></i> Unifood@gmail.com</a>
                    </li>
                    <li><a href="callto:123456789"><i class="fas fa-phone-alt"></i> +96487452145214</a></li>
                </ul>
            </div>
            <div class="col-xl-6 col-md-4 d-none d-md-block">
                <ul class="topbar_icon d-flex flex-wrap">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a> </li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a> </li>
                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a> </li>
                    <li><a href="#"><i class="fab fa-behance"></i></a> </li>
                </ul>
            </div>
        </div>
    </div>
</section>
{{-- =============================
        TOPBAR END
    ============================== --}}


{{-- =============================
        MENU START
    ============================== --}}
<nav class="navbar navbar-expand-lg main_menu">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('frontend/images/logo.png') }}" alt="FoodPark" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">about</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.html">menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('chef') }}">chefs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">pages <i class="far fa-angle-down"></i></a>
                    <ul class="droap_menu">
                        <li><a href="{{ route('testimonial') }}">Testimonials</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blogs.html">blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">contact</a>
                </li>
            </ul>
            <ul class="menu_icon d-flex flex-wrap">
                <li>
                    <a href="#" class="menu_search"><i class="far fa-search"></i></a>
                    <div class="fp__search_form">
                        <form>
                            <span class="close_search"><i class="far fa-times"></i></span>
                            <input type="text" placeholder="Search . . .">
                            <button type="submit">search</button>
                        </form>
                    </div>
                </li>
                <li>
                    <a class="cart_icon"><i class="fas fa-shopping-basket"></i>
                        <span class="cart_count">{{ count(Cart::content()) }}</span></a>
                </li>
                @php
                    // @$unseenMessages = \App\Models\Chat::where([
                    //     'sender_id' => 1,
                    //     'receiver_id' => Auth::user()->id,
                    //     'seen' => 0,
                    // ])->count();

                    @$unseenMessages= '';
                @endphp
                <li>
                    <a class="message_icon" href="{{ route('dashboard') }}">
                        <i class="fas fa-comment-alt-dots"></i>

                        <span class="sunseen-message-count">{{ $unseenMessages > 0 ? 1 : 0 }}</span>

                    </a>
                </li>
                <li>
                    <a href="{{ route('login') }}"><i class="fas fa-user"></i></a>
                </li>
                <li>
                    <a class="common_btn" href="#" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">reservation</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="fp__menu_cart_area">
    <div class="fp__menu_cart_boody">
        <div class="fp__menu_cart_header">
            <h5>total item (<span class="cart_count">{{ count(Cart::content()) }}</span>)</h5>
            <span class="close_cart"><i class="fal fa-times"></i></span>
        </div>
        <ul class="cartContent">
            {{-- @foreach (Cart::content() as $cartContent)
                    <li>
                        <div class="menu_cart_img">
                            <img src="{{ asset($cartContent->options->product_info['image']) }}" alt="menu" class="img-fluid w-100">
                        </div>
                        <div class="menu_cart_text">
                            <a class="title" href="{{ route('product.show', $cartContent->options->product_info['slug']) }}">{!! $cartContent->name !!}</a>
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
                        <span class="del_icon" data-product-id="{{ $cartContent->rowId }}"><i class="fal fa-times"></i></span>
                    </li>
                @endforeach --}}
            @include('frontend.layouts.ajax_files.sidebarCartItem')
        </ul>
        <p class="subtotal">sub total <span class="cart_subtotal"
                id="cartSubtotal">{{ currencyPosition(cartTotal()) }}</span></p>
        <a class="cart_view" href="{{ route('cart.index') }}"> view cart</a>
        <a class="checkout" href="check_out.html">checkout</a>
    </div>
</div>

<div class="fp__reservation">
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Book a Table</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="fp__reservation_form">
                        <input class="reservation_input" type="text" placeholder="Name">
                        <input class="reservation_input" type="text" placeholder="Phone">
                        <input class="reservation_input" type="date">
                        <select class="reservation_input" id="select_js">
                            <option value="">select time</option>
                            <option value="">08.00 am to 09.00 am</option>
                            <option value="">10.00 am to 11.00 am</option>
                            <option value="">12.00 pm to 01.00 pm</option>
                            <option value="">02.00 pm to 03.00 pm</option>
                            <option value="">04.00 pm to 05.00 pm</option>
                        </select>
                        <select class="reservation_input" id="select_js2">
                            <option value="">select person</option>
                            <option value="">1 person</option>
                            <option value="">2 person</option>
                            <option value="">3 person</option>
                            <option value="">4 person</option>
                            <option value="">5 person</option>
                        </select>
                        <button type="submit">book table</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- =============================
        MENU END
    ============================== --}}
