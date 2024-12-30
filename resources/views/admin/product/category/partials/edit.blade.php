@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Caregory</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Update Category</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option @selected($category->status === true) value="1">Active</option>
                                    <option @selected($category->status === false) value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Show at home page</label>
                                <select name="show_at_home" class="form-control">
                                    <option @selected($category->show_at_home) value="1">Yes</option>
                                    <option @selected($category->show_at_home) value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Name category</label>
                                <input type="text" name="name" class="form-control"
                                value="{{ $category->name }}">
                            </div>
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control"
                                value="{{ $category->slug }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
