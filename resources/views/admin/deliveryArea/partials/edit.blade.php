@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Delivery Area</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.delivery_areas.index') }}">All Delivery Areas</a></div>
                <div class="breadcrumb-item fs4">Edit Delivery Area</div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Edit Delivery Area</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.delivery_areas.update', $deliveryArea->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Area Name</label>
                                <input type="text" name="area_name" class="form-control" value="{{ old('area_name', $deliveryArea->area_name) }}" >
                            </div>
                            <div class="form-group">
                                <label>Minimum Delivery Time</label>
                                <input type="text" name="min_delivery_time" class="form-control" value="{{ old('min_delivery_time', $deliveryArea->min_delivery_time) }}" >
                            </div>
                            <div class="form-group">
                                <label>Maximum Delivery Time</label>
                                <input type="text" name="max_delivery_time" class="form-control" value="{{ old('max_delivery_time', $deliveryArea->max_delivery_time) }}" >
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Delivery Fee</label>
                                <input type="number" name="delivery_fee" class="form-control" value="{{ old('delivery_fee', $deliveryArea->delivery_fee) }}" step="0.01" >
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" >
                                    <option value="1" {{ $deliveryArea->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $deliveryArea->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
