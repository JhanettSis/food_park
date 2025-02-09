    {{-- ==================================================
        Banner Slider Section START
    ====================================================== --}}
    <section class="fp__banner" style="background: url(frontend/images/banner_bg.jpg);">
        <div class="fp__banner_overlay">
            <div class="row banner_slider">
                @foreach ($sliders as $slider)
                <div class="col-12">
                    <div class="fp__banner_slider">
                        <div class=" container">
                            <div class="row">
                                <div class="col-xl-5 col-md-4 col-lg-5">
                                    <div class="fp__banner_img wow fadeInLeft" data-wow-duration="2s">
                                        <div class="img">
                                            <img src="{{ asset($slider->image) }}" alt="food item"
                                                class="img-fluid w-100">
                                            <span> {{ $slider->offer }} </span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-7 col-lg-6">
                                    <div class="fp__banner_text wow fadeInRight" data-wow-duration="2s">
                                        <h1>{{ $slider->title }}</h1>
                                        <h3>{{ $slider->subtitle }}</h3>
                                        <p>{{ $slider->short_description }}</p>
                                        <ul class="d-flex flex-wrap">
                                            <li><a class="common_btn" href="{{ $slider->button_link }}">Shop Now</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- ==================================================
        Banner Slider Section END
    ====================================================== --}}
