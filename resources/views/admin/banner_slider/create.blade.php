@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Banner Slider</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item fs4"><a href="{{ route('admin.banner_slider.index') }}">All Banners</a></div>
                <div class="breadcrumb-item fs4">Create New Banner</div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Create Banner Slider</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.banner_slider.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Image</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>

                    <div class="form-group">
                        <label for="">Sub Title</label>
                        <input type="text" class="form-control" name="sub_title">
                    </div>

                    <div class="form-group">
                        <label for="">Url</label>
                        <input type="text" class="form-control" name="url">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection
