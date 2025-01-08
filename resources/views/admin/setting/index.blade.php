@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Settings</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item fs4"> Settings </div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>All Settings</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-2">
                        <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#generalSettings"
                                    role="tab" aria-controls="home" aria-selected="true">General Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab"
                                    aria-controls="profile" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab"
                                    aria-controls="contact" aria-selected="false">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-10">
                        <div class="tab-content no-padding" id="myTab2Content">
                            <div class="tab-pane fade show active" id="generalSettings" role="tabpanel"
                                aria-labelledby="home-tab4">
                                <form action="{{ route('admin.general_setting.update') }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="">Site Name</label>
                                        <input type="text" name="site_name" class="form-control"
                                            value="{{ config('settings.site_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Default currency</label>
                                        <select name="site_default_currency" id="" class="form-control select2">
                                            <option value="">Select</option>
                                            @foreach (config('currencies.currency_list') as $name => $code)
                                                <option @selected(config('settings.site_default_currency') === $code) value="{{ $code }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Currency Icon</label>
                                                <input type="text" name="site_currency_icon" class="form-control"
                                                    value="{{ config('settings.site_currency_icon') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Currency Icon Position</label>
                                                <select name="site_currency_icon_position" id=""
                                                    class="form-control select2">
                                                    <option @selected(config('settings.site_currency_icon_position') === 'right') value="right">Right</option>
                                                    <option @selected(config('settings.site_currency_icon_position') === 'left') value="left">Left</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>

                                </form>

                            </div>
                            <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                                Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est
                                lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis
                                iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui. Aliquam convallis neque
                                eget tellus efficitur, eget maximus massa imperdiet. Morbi a mattis velit. Donec hendrerit
                                venenatis justo, eget scelerisque tellus pharetra a.
                            </div>
                            <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                                Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa,
                                gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum
                                molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci
                                non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis
                                ultrices. Proin bibendum bibendum augue ut luctus.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
