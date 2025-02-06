@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Declined Orders</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">List Declined Orders</div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>All Declined Orders</h4>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </section>
    {{-- Modal Order Displayed here --}}
    @include('admin.order.form-modal-order')

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    {{-- Script for get the form on a modal and update the info --}}
    @include('admin.order.scripGet-UpdateModalForm')
@endpush
