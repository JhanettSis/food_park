@extends('frontend.layouts.master')
@section('content')

{{--=============================
        BREADCRUMB START
    ==============================--}}
    <section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>checkout</h1>
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="#">checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    {{--=============================
        BREADCRUMB END
    ==============================--}}


    {{--============================
        CHECK OUT PAGE START
    ==============================--}}
    <section class="fp__cart_view mt_125 xs_mt_95 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-7 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__checkout_form">
                        <div class="fp__check_form">
                            <h5>select address <a href="#" data-bs-toggle="modal" data-bs-target="#address_modal"><i
                                        class="far fa-plus"></i> add address</a></h5>

                            <div class="fp__address_modal">
                                <div class="modal fade" id="address_modal" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="address_modalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="address_modalLabel">Add new address
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="fp_dashboard_new_address d-block">
                                                    <form action="{{ route('address.store') }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="fp__check_single_form">
                                                                    {{-- I remplaced the id=slect_js4 <select id="select_js4" name="area">
                                                                            for class nice-select--}}
                                                                    <select class="nice-select" name="area">
                                                                        <option value="">select Area</option>
                                                                        @foreach ($supportedAreas as $area)
                                                                            <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="fp__check_single_form">
                                                                    <input type="text" name="first_name" placeholder="First Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="fp__check_single_form">
                                                                    <input type="text" name="last_name" placeholder="Last Name">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="fp__check_single_form">
                                                                    <input type="text" name="phone" placeholder="Phone *">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="fp__check_single_form">
                                                                    <input type="email" name="email" placeholder="Email *">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="fp__check_single_form">
                                                                    <textarea cols="3" rows="4" name="address" placeholder="Address"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="fp__check_single_form">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="type" id="flexRadioDefault1"
                                                                            value="home">
                                                                        <label class="form-check-label" for="flexRadioDefault1">home</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="type" id="flexRadioDefault2"
                                                                            value="office">
                                                                        <label class="form-check-label" for="flexRadioDefault2">office</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 check_area_modal">
                                                                <button type="submit" class="common_btn">save address</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @foreach ($addresses as $address)
                                <div class="col-md-6">
                                    <div class="fp__checkout_single_address">
                                        <div class="form-check">
                                            <input class="form-check-input v_address" value="{{ $address->id }}" type="radio" name="flexRadioDefault"
                                                id="home">
                                            <label class="form-check-label" for="home">
                                                @if ($address->type === 'home')
                                                <span class="icon"><i class="fas fa-home"></i> home</span>
                                                @else
                                                <span class="icon"><i class="far fa-car-building"></i> office</span>
                                                @endif
                                                <span class="address">{{ $address->address }}, {{ $address->deliveryArea?->area_name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div id="sticky_sidebar" class="fp__cart_list_footer_button">
                        <h6>total cart</h6>
                        <p>subtotal: <span>{{ cartTotal() }}</span></p>
                        <p>delivery: <span id="delivery_fee">{{ currencyPosition(0) }}</span></p>
                        @if (session()->has('coupon'))
                        <p>discount: <span>{{ session()->get('coupon')['discount']  }}</span></p>
                        @else
                        <p>discount: <span>{{ currencyPosition(0)  }}</span></p>
                        @endif

                        <p class="total"><span>total:</span>
                            @if (session()->has('coupon') && session()->get('coupon')['discount'])
                            <span id="final_total">{{ session()->get('coupon')['finalTotal'] }}</span>
                            @else
                            <span id="final_total">{{ cartTotal() }}</span>
                            @endif
                        </p>
                        <a class="common_btn" href=" #">checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--============================
        CHECK OUT PAGE END
    ==============================--}}

@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $('.v_address').prop('checked', false);
        $('.v_address').on('click', function(){
            let addressId = $(this).val();
            let deliveryFee = $('#delivery_fee');
            let grandTotal = $('#final_total');
            $.ajax({
                method: 'GET',
                url: '{{ route("checkout.delivery-calculation", ":id") }}'.replace(":id", addressId),
                beforeSend: function(){
                    showLoader(); // This function shows a loading spinner
                },
                success: function(response){
                    deliveryFee.text(response.delivery_fee);
                    grandTotal.text(response.grand_total);
                    toastr.success(response.message);

                },
                error: function(xhr, status, error){
                    let errorMessage = xhr.responseJSON.message;
                    toastr.error(errorMessage);
                },
                complete: function(){
                    hiddeLoader(); // Hide loading spinner after request is complete
                }
            })
        })
    })
</script>
@endpush
