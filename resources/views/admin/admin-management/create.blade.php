@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Create New Admin User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.admin-management.index') }}">All List</a></div>
            <div class="breadcrumb-item">Create New Admin</div>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Create Admin</h4>

        </div>
        <div class="card-body">
            <form action="{{ route('admin.admin-management.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" id="" class="form-control">
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</section>
@endsection
