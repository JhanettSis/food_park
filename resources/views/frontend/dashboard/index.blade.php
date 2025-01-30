@extends('frontend.layouts.master')

@section('content')
    {{--=============================
                BREADCRUMB START
            ==============================--}}
    <section class="fp__breadcrumb" style="background: url(frontend/images/counter_bg.jpg);">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>user dashboard</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="">dashboard</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    {{--=============================
                BREADCRUMB END
            ==============================--}}


    {{--=========================
                DASHBOARD START
            ==========================--}}
    <section class="fp__dashboard mt_120 xs_mt_90 mb_100 xs_mb_70">
        <div class="container">
            <div class="fp__dashboard_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__dashboard_menu">
                            @include('frontend.dashboard.image_profile')
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-home" type="button" role="tab"
                                    aria-controls="v-pills-home" aria-selected="true"><span><i
                                            class="fas fa-user"></i></span> Parsonal Info</button>

                                <button class="nav-link" id="v-pills-address-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-address" type="button" role="tab"
                                    aria-controls="v-pills-address" aria-selected="true"><span><i
                                            class="fas fa-user"></i></span>address</button>

                                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-profile" type="button" role="tab"
                                    aria-controls="v-pills-profile" aria-selected="false"><span><i
                                            class="fas fa-bags-shopping"></i></span> Order</button>

                                @php
                                // $unseenMessages = \App\Models\Chat::where(['sender_id' => 1, 'receiver_id' => Auth::user()->id, 'seen' => 0])->count();
                                @$unseenMessages= '';
                                @endphp
                                <button class="nav-link fp_chat_message" id="v-pills-message-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-message" type="button" role="tab"
                                aria-controls="v-pills-message" aria-selected="false"><span><i
                                class="far fa-comment-dots"></i></span> Message
                                <b class="sunseen-message-count">{{ $unseenMessages > 0 ? 1 : 0 }}</b>
                                </button>

                                <button class="nav-link" id="v-pills-messages-tab2" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-messages2" type="button" role="tab"
                                    aria-controls="v-pills-messages2" aria-selected="false"><span><i
                                            class="far fa-heart"></i></span> wishlist</button>

                                <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-messages" type="button" role="tab"
                                    aria-controls="v-pills-messages" aria-selected="false"><span><i
                                            class="fas fa-star"></i></span> Reviews</button>

                                <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-settings" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false"><span><i
                                            class="fas fa-user-lock"></i></span> Change Password </button>


                                {{-- Authentication --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="nav-link" type="button" aria-selected="false" tabindex="-1" role="tab"onclick="event.preventDefault();
                                        this.closest('form').submit();" >
                                        <span> <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                    </span> Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__dashboard_content">
                            <div class="tab-content" id="v-pills-tabContent">

                                @include('frontend.dashboard.section.personal_info')

                                @include('frontend.dashboard.section.address_section')

                                @include('frontend.dashboard.section.order-section')

                                @include('frontend.dashboard.section.message-section')

                                {{-- <div class="tab-pane fade" for change password  --}}
                                @include('frontend.dashboard.change_password')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- -- CART POPUT START -- --}}
        <div class="fp__cart_popup">
            <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                    class="fal fa-times"></i></button>
                            <div class="fp__cart_popup_img">
                                <img src="images/menu1.png" alt="menu" class="img-fluid w-100">
                            </div>
                            <div class="fp__cart_popup_text">
                                <a href="#" class="title">Maxica5678 Pizza Test Better</a>
                                <p class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                    <span>(201)</span>
                                </p>
                                <h4 class="price">$320.00 <del>$350.00</del> </h4>

                                <div class="details_size">
                                    <h5>select size</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="large01" checked>
                                        <label class="form-check-label" for="large01">
                                            large <span>+ $350</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="medium01">
                                        <label class="form-check-label" for="medium01">
                                            medium <span>+ $250</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="small01">
                                        <label class="form-check-label" for="small01">
                                            small <span>+ $150</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="details_extra_item">
                                    <h5>select option <span>(optional)</span></h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="coca-cola01">
                                        <label class="form-check-label" for="coca-cola01">
                                            coca-cola <span>+ $10</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="7up01">
                                        <label class="form-check-label" for="7up01">
                                            7up <span>+ $15</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="details_quentity">
                                    <h5>select quentity</h5>
                                    <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                                        <div class="quentity_btn">
                                            <button class="btn btn-danger"><i class="fal fa-minus"></i></button>
                                            <input type="text" placeholder="1">
                                            <button class="btn btn-success"><i class="fal fa-plus"></i></button>
                                        </div>
                                        <h3>$320.00</h3>
                                    </div>
                                </div>
                                <ul class="details_button_area d-flex flex-wrap">
                                    <li><a class="common_btn" href="#">add to cart</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- CART POPUT END --}}

    </section>
    {{--=========================  DASHBOARD END   ==========================--}}
@endsection
