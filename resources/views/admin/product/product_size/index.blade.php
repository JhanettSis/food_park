@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Sizes and Options Product {{ $product->product_name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">All Products</a></div>
                <div class="breadcrumb-item fs4"> Sizes Product</div>
            </div>
        </div>
        <div class="row">
            <!-- Section for Sizes start -->
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Add sizes for the Product</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.product-size.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name of the Size</label>
                                        <input type="text" class="form-control" name="size_name">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Create</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>All Sizes of the Product</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name Size Product</th>
                                    <th>Price Size Product</th>
                                    <th>Action</th>
                                </tr>
                            <tbody>
                                @foreach ($product_sizes as $product_size)
                                    <tr>
                                        <td>{{ $product_size->size_name }}</td>
                                        <td>{{ currencyPosition($product_size->price) }}</td>
                                        <td><a href="{{ route('admin.product-size.destroy', $product_size->id) }}"
                                                class="btn btn-danger delete-item"><i class="fas fa-trash"></i></a></td>
                                    </tr>
                                @endforeach
                                @if (count($product_sizes) === 0)
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
            <!-- Section for Sizes end -->

            <!-- Section for Options start -->
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Add Options for the Product</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.product-option.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name of the Size</label>
                                        <input type="text" class="form-control" name="option_name">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Create</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>All Options of the Product</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name option Product</th>
                                    <th>Price Option Product</th>
                                    <th>Action</th>
                                </tr>
                            <tbody>
                                @foreach ($product_options as $product_option)
                                    <tr>
                                        <td>{{ $product_option->option_name }}</td>
                                        <td>{{ currencyPosition($product_option->price) }}</td>
                                        <td><a href="{{ route('admin.product-option.destroy', $product_option->id) }}"
                                                class="btn btn-danger delete-item"><i class="fas fa-trash"></i></a></td>
                                    </tr>
                                @endforeach
                                @if (count($product_options) === 0)
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
            <!-- Section for Options end -->
        </div>



    </section>
@endsection
