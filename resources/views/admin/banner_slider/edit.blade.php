@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Banner Slider</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item fs4"><a href="{{ route('admin.banner_slider.index') }}">All Banners</a></div>
                <div class="breadcrumb-item fs4">Update Banner</div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Udate Banner Slider</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.banner_slider.update', $bannerSlider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Image</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload" />
                            <input type="hidden" name="old_image" value="{{ $bannerSlider->banner }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $bannerSlider->title }}">
                    </div>

                    <div class="form-group">
                        <label for="">Sub Title</label>
                        <input type="text" class="form-control" name="sub_title" value="{{ $bannerSlider->sub_title }}">
                    </div>

                    <div class="form-group">
                        <label for="">Url</label>
                        <input type="text" class="form-control" name="url" value="{{ $bannerSlider->url }}">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option @selected($bannerSlider->status === true) value="1">Active</option>
                            <option @selected($bannerSlider->status === false) value="0">Inactive</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.image-preview').css({
                'background-image': 'url({{ asset($bannerSlider->banner) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
