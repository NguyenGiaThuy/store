@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Add New Product</h4>
                    <p class="card-category">Complete product details</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('editor.products.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Product Name</label>
                                    <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" required autofocus>

                                    @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating" >Product Brand</label>
                                    <input type="text" name="brand" class="form-control" value="{{ old('brand') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Product Price</label>
                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Product Type</label>
                                    <input type="text" name="type" class="form-control" value="{{ old('type') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Product Catalog ID</label>
                                    <input type="text" name="catalog_id" class="form-control" value="{{ old('catalog_id') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Product Image Link</label>
                                    <input type="text" name="image" class="form-control" value="{{ old('image') }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Add Product</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
@endsection
