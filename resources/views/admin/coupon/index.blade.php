@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Coupons</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item fs4"> Coupons Section </div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>All Coupons Items</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
                        Create
                    </a>
                </div>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
