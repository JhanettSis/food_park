@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create Coupon</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item fs4"><a href="{{ route('admin.coupons.index') }}">All Coupons</a></div>
                <div class="breadcrumb-item fs4">Create New Coupon</div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Create New Coupon</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.coupons.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="name">Coupon Name</label>
                                <input type="text" name="name" id="name" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="code">Coupon Code</label>
                                <input type="text" name="code" id="code" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control"  min="1">
                            </div>
                            <div class="form-group">
                                <label for="min_purchase_amount">Minimum Purchase Amount</label>
                                <input type="number" name="min_purchase_amount" id="min_purchase_amount" class="form-control"  min="0">
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="expire_date">Expire Date</label>
                                <input type="date" name="expire_date" id="expire_date" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="discount_type">Discount Type</label>
                                <select name="discount_type" id="discount_type" class="form-control select2" >
                                    <option value="percentage">Percentage</option>
                                    <option value="amount">Amount</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="number" name="discount" id="discount" class="form-control"  min="1">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" >
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Coupon</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
