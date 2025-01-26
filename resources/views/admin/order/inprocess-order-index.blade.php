@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>In Process Orders</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>All In Process Orders</h4>
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
