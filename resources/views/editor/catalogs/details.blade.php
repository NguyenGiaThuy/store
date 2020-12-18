@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Edit Catalog Details</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('editor.catalogs.update', $id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Catalog ID (disabled)</label>
                                    <input type="text" class="form-control" value="{{ $id }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Catalog Name</label>
                                    <input id="catalog_name" type="text"
                                           class="form-control @error('catalog_name') is-invalid @enderror"
                                           name="catalog_name" value="{{ $catalog_name }}" required>

                                    @error('catalog_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Update Catalog Details</button>

                        <button class="btn btn-primary pull-right" href="{{ route('editor.catalogs.destroy', $id) }}"
                                onclick="event.preventDefault();
                           document.getElementById('delete-catalog-form').submit();">
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
                    @include('editor.partials.product-list')
                </div>
            </div>
        </div>

        <form id="delete-catalog-form" action="{{ route('editor.catalogs.destroy', $id) }}" method="POST"
              class="d-none">
            @csrf
            @method('DELETE')
        </form>
@endsection
