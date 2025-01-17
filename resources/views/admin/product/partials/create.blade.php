@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Create new Product</h4>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                                <div class="col-sm-12 col-md-7">
                                    <div id="image-preview" class="image-preview">
                                        <label for="image-upload" id="image-label">Choose File</label>
                                        <input type="file" name="product_image" id="image-upload" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Name product</label>
                                <input type="text" name="product_name" class="form-control"
                                value="{{ old('product_name') }}">
                            </div>
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control select2">
                                    <option value="">select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{ currencyIconInput() }}</div>
                                    </div>
                                    <input type="text" name="price" class="form-control currency"
                                    value="{{ old('price') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Offer price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{ currencyIconInput() }}</div>
                                    </div>
                                    <input type="text" name="offer_price" class="form-control currency"
                                    value="{{ old('offer_price') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="quantity" class="form-control" value="">
                            </div>
                        </div>


                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Short Product Descrption </label>
                                <textarea name="short_description" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Long Product Descrption </label>
                                <textarea name="long_description" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Sku</label>
                                <input type="text" name="sku" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Seo Title</label>
                                <input type="text" name="seo_title" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Seo Description </label>
                                <textarea name="seo_description" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Show at home page</label>
                                <select name="show_at_home" class="form-control">
                                    <option value="1">Yes</option>
                                    <option selected value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
