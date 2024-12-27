@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Silder</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Modify the Slider</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                                <div class="col-sm-12 col-md-7">
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Choose File</label>
                                        <input type="file" name="image" id="image-upload" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Offer</label>
                                <input type="text" name="offer" class="form-control" value="{{ $slider->offer }}">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <!-- There are two ways to display the option form the database value -->
                                    <!-- First way { { $slider->status === true ? 'selected' : '' }} -->
                                    <option {{ $slider->status === true ? 'selected' : '' }} value="1">Active</option>
                                    <!-- Second way @ selected($slider->status === 0)  -->
                                    <option @selected($slider->status === false) value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $slider->title }}">
                            </div>
                            <div class="form-group">
                                <label>Subtitle</label>
                                <input type="text" name="subtitle" class="form-control" value="{{ $slider->subtitle }}">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="short_description" rows="9" class="form-control">
                                    {{ $slider->short_description }}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label>Button link</label>
                                <input type="text" name="button_link" class="form-control"
                                    value="{{ $slider->button_link }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.image-preview').css({
                'background-image': 'url({{ asset($slider->image) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
