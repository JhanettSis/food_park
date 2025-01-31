@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Settings1212</h1>
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
                                <a class="nav-link active" id="generalSettings-tab4" data-toggle="tab" href="#generalSettings"
                                    role="tab" aria-controls="generalSettings" aria-selected="true">General Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="logo-tab4" data-toggle="tab" href="#logoSetting" role="tab"
                                    aria-controls="logo" aria-selected="true">Logo Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="appearance-tab4" data-toggle="tab" href="#appearance-setting" role="tab"
                                    aria-controls="appearance" aria-selected="true">Appearance Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pusher-tab4" data-toggle="tab" href="#pusherSetting"
                                    role="tab" aria-controls="pusher" aria-selected="false">Pusher Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="mail" data-toggle="tab" href="#mailSetting" role="tab"
                                    aria-controls="mail" aria-selected="false">Mail Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="seo" data-toggle="tab" href="#seoSetting" role="tab"
                                    aria-controls="seo" aria-selected="false">Seo Settings</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-10">
                        <div class="tab-content no-padding" id="myTab2Content">

                            @include('admin.setting.sections.general-setting')

                            @include('admin.setting.sections.logo-setting')

                            @include('admin.setting.sections.appearance-setting')

                            @include('admin.setting.sections.pusher-setting')

                            @include('admin.setting.sections.mail-setting')

                            @include('admin.setting.sections.seo-setting')


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
