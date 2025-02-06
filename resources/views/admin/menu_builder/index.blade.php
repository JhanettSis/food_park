@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Menu Builder</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item fs4">All Menu </div>
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>All Menus</h4>
            </div>
            <div class="card-body">
                {!! LaravelMenu::render() !!}
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {!! LaravelMenu::scripts() !!}
@endpush
