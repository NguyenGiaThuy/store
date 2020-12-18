@extends('layouts.manage')

@section('content')
    <div class="col-md-4">
        <div class="card card-profile">
            <div class="card-avatar">
                <a href="javascript:;">
                    <img class="img" src="{{ $image }}" img/>
                </a>
            </div>
            <div class="card-body">
                <h6 class="card-category text-gray">{{ $product_name }}</h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Edit Product Details</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('editor.products.update', $id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Product ID (disabled)</label>
                                    <input type="text" name="id" class="form-control" value="{{ $id }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Product Name</label>
                                    <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ $product_name }}" required autofocus>

                                    @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Product Brand</label>
                                    <input type="text" name="brand" class="form-control" value="{{ $brand }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Product Price</label>
                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $price }}" required>

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
                                    <input type="text" name="type" class="form-control" value="{{ $type }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Product Catalog ID:</label>
                                    <input type="text" name="catalog_id" class="form-control" value="{{ $catalog_id }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Product Image Link</label>
                                    <input type="text" name="image" class="form-control" value="{{ $image }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Update Product Details</button>

                        <button class="btn btn-primary pull-right" href="{{ route('editor.products.destroy', $id) }}"
                           onclick="event.preventDefault();
                           document.getElementById('delete-form').submit();">
                            {{ __('Delete') }}
                        </button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>

        <form id="delete-form" action="{{ route('editor.products.destroy', $id) }}" method="POST"
              class="d-none">
            @csrf
            @method('DELETE')
        </form>
@endsection
