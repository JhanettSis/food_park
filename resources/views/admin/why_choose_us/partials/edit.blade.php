@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Title for 'Why Choose Us' section</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Update Item</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.why_choose_us.update', $whyChooseUs->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control"
                                value="{{ $whyChooseUs->title }}">
                            </div>
                            <div class="form-group">
                                <label>Icon</label>
                                <!-- Button tag -->
                                <button name="icon" data-icon="{{ $whyChooseUs->icon }}" class="btn btn-secondary" data-iconset="fontawesome5" data-icon="fas fa-wifi" role="iconpicker"></button>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Short Description</label>
                                <textarea name="short_description" rows="9" class="form-control">
                                    {{ $whyChooseUs->short_description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option @selected($whyChooseUs->status === 1) value="1">Yes</option>
                                    <option @selected($whyChooseUs->status === 0) value="0">No</option>
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
