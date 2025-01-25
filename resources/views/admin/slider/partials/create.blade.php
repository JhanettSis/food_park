@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Silder</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">All Sliders</a></div>
                <div class="breadcrumb-item">New Slider</div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Create new Slider</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                                <div class="col-sm-12 col-md-7">
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Choose File</label>
                                        <input type="file" name="image" id="image-upload" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Offer</label>
                                <input type="text" name="offer" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Subtitle</label>
                                <input type="text" name="subtitle" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="short_description" rows="9" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Button link</label>
                                <input type="text" name="button_link" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
