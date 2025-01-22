<div class="tab-pane fade" id="v-pills-address" role="tabpanel" aria-labelledby="v-pills-address-tab">
    <div class="fp_dashboard_body address_body">
        <h3>address <a class="dash_add_new_address"><i class="far fa-plus"></i> add new</a></h3>
        <div class="fp_dashboard_address">
            @if ($userAddresses->count() > 0)
                <div class="fp_dashboard_existing_address">
                    <div class="row">
                        @foreach ($userAddresses as $userAddress)
                            <div class="col-md-6">
                                <div class="fp__checkout_single_address">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <span class="icon">
                                                @if ($userAddress->type === 'office')
                                                    <i class="far fa-building"></i>
                                                @else
                                                    <i class="fas fa-home"></i>
                                                @endif
                                                {{ ucfirst($userAddress->type) }}
                                            </span>
                                            <span class="address">{{ $userAddress->address }},
                                                {{ $userAddress->deliveryArea?->area_name }}</span>
                                        </label>
                                    </div>
                                    <ul>
                                        <li><a class="dash_edit_btn show_edit_section"
                                                data-class="edit_section_{{ $userAddress->id }}"><i
                                                    class="far fa-edit"></i></a></li>
                                        <li><a href="{{ route('address.destroy', $userAddress->id) }}" class="dash_del_icon delete-item"><i class="fas fa-trash-alt"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p>No addresses found. Add your address now.</p>
            @endif

            <div class="fp_dashboard_new_address">
                <form action="{{ route('address.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h4>add new address</h4>
                        </div>
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
                            <div class="fp__check_single_form check_area">
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
                        <div class="col-12">
                            <button type="button" class="common_btn cancel_new_address">cancel</button>
                            <button type="submit" class="common_btn">save address</button>
                        </div>
                    </div>
                </form>
            </div>
            @foreach ($userAddresses as $address)
                <!-- Edit Address Form (Initially hidden) -->
                <div class="fp_dashboard_edit_address edit_section_{{ $address->id }}">
                    <form action="{{ route('address.update', $address->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="fp__check_single_form">
                                    {{-- I remplaced the id=slect_js4 <select id="select_js4" name="area">
                                        for class nice-select--}}
                                    <select class="nice-select" name="area">
                                        @foreach ($supportedAreas as $area)
                                            <option @selected($address->delivery_area_id === $area->id) value="{{ $area->id }}">
                                                {{ $area->area_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fp__check_single_form">
                                    <input type="text" name="first_name" value="{{ $address->first_name }}"
                                        placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fp__check_single_form">
                                    <input type="text" name="last_name" value="{{ $address->last_name }}"
                                        placeholder="Last Name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="fp__check_single_form">
                                    <input type="text" name="phone" value="{{ $address->phone }}"
                                        placeholder="Phone *">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fp__check_single_form">
                                    <input type="email" name="email" value="{{ $address->email }}"
                                        placeholder="Email *">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="fp__check_single_form">
                                    <textarea cols="3" rows="4" name="address" placeholder="Address">{{ $address->address }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="fp__check_single_form check_area">
                                    <div class="form-check">
                                        <input class="form-check-input" @checked($address->type === 'home') type="radio"
                                            name="type" id="flexRadioDefault1" value="home">
                                        <label class="form-check-label" for="flexRadioDefault1">home</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" @checked($address->type === 'office') type="radio"
                                            name="type" id="flexRadioDefault2" value="office">
                                        <label class="form-check-label" for="flexRadioDefault2">office</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="button" class="common_btn cancel_edit_address">cancel</button>
                                <button type="submit" class="common_btn">update address</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach


        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            // Show the edit form for the clicked address
            $('.show_edit_section').on('click', function() {
                let classEdit = $(this).data('class'); // Get the data-class attribute
                // Hide all other edit forms and existing addresses
                $('.fp_dashboard_edit_address').addClass('d-none'); // Hide all edit forms
                $('.fp_dashboard_existing_address').addClass('d-none'); // Hide the existing addresses list

                // Show the selected edit form
                $('.' + classEdit).removeClass('d-none').addClass('d-block'); // Show the clicked edit form
            });

            // Cancel the edit form and go back to the existing addresses list
            $('.cancel_edit_address').on('click', function() {
                // Hide the edit form and show the existing addresses list again
                $('.fp_dashboard_edit_address').addClass('d-none');
                $('.fp_dashboard_existing_address').removeClass('d-none').addClass('d-block');
            });
        });
    </script>
@endpush
