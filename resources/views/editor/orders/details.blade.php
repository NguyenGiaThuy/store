@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Edit Order Details</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('editor.orders.update', $id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Order ID (disabled)</label>
                                    <input type="text" class="form-control" value="{{ $id }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Total Price (disabled)</label>
                                    <input type="text" class="form-control" value="{{ $total_price }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Owner</label>
                                    <input id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ $user_id }}" required autofocus>

                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Date Create (disabled)</label>
                                    <input type="text" class="form-control" value="{{ $created_at }}" disabled>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Update Order Details</button>

                        <button class="btn btn-primary pull-right" href="{{ route('editor.orders.destroy', $id) }}"
                                onclick="event.preventDefault();
                           document.getElementById('delete-order-form').submit();">
                            {{ __('Delete') }}
                        </button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="form-group">
                    <h2>Product List</h2>
                </div>
            </div>
            <div class="col-md-auto center" style="margin-left: auto; margin-right: auto;">
                <div class="form-group">
                    @include('editor.orders.partials.product-list')
                </div>
            </div>

            <form id="delete-order-form" action="{{ route('editor.orders.destroy', $id) }}" method="POST"
                  class="d-none">
                @csrf
                @method('DELETE')
            </form>
        </div>

@endsection
