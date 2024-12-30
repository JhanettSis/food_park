@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Title for 'Why Choose Us' section</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Create new Item</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.why_choose_us.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Icon</label>
                                <!-- Button tag -->
                                <button name="icon" class="btn btn-secondary" data-iconset="fontawesome5" data-icon="fas fa-wifi" role="iconpicker"></button>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Short Description</label>
                                <textarea name="short_description" rows="9" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
