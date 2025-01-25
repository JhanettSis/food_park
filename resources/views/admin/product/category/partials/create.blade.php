@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Caregory</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">All Categories</a></div>
                <div class="breadcrumb-item fs4"> New Category</div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Create new Category</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Show at home page</label>
                                <select name="show_at_home" class="form-control">
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Name category</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
