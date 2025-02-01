@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Privacy Policy</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Privacy Policy</div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Update Privacy Policy</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.privacy_policy.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="content" class="summernote form-control">{!! @$privacyPolicy->content !!}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection

