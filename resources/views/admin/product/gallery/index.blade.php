@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Gallery {{ $product->product_name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">All Products</a></div>
                <div class="breadcrumb-item fs4">Product Gallery</div>
            </div>
        </div>
        <div>
            <a href="{{ route('admin.products.index') }}"></a>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Add Product Images</h4>
            </div>
            <div class="card-body">
                <div class="col-md-8">
                    <form action="{{ route('admin.product-gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" class="form-control" name="gallery_image">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>All Product Gallery Images</h4>
            </div>
            <div class="card-body">
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        <tbody>
                            @foreach ($galleryImages as $image)
                                <tr>
                                    <td><img src="{{ asset($image->gallery_image) }}"
                                            alt="One image of the specific product"></td>
                                    <td><a href="{{ route('admin.product-gallery.destroy', $image->id) }}"
                                            class="btn btn-danger delete-item"><i class="fas fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                            @if (count($galleryImages) === 0)
                                <tr>
                                    <td colspan="2" class="text-center">
                                        No data found!
                                    </td>
                                </tr>
                            @endif
                        </tbody>

                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
