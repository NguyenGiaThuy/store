@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Add New Order</h4>
                    <p class="card-category">Complete order details</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('editor.orders.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Order ID</label>
                                    <input id="id" type="text" class="form-control @error('id') is-invalid @enderror"
                                           name="id" value="{{ old('id') }}" required autofocus>

                                    @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Owner ID</label>
                                    <input id="user_id" type="text"
                                           class="form-control @error('user_id') is-invalid @enderror"
                                           name="user_id" value="{{ old('user_id') }}" required>

                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Products To Add (Input sample: 1,2,3,4,5,etc.)</label>
                                    <input id="products" type="text"
                                           class="form-control @error('products') is-invalid @enderror"
                                           name="products" value="{{ old('products') }}" required>

                                    @error('products')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h2>Product List</h2>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    @include('editor.partials.product-list')
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary pull-right">Add Order</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
@endsection
