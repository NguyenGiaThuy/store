@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Add New Catalog</h4>
                    <p class="card-category">Complete catalog details</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('editor.catalogs.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Catalog ID</label>
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
                                    <label class="bmd-label-floating">Catalog Name</label>
                                    <input id="catalog_name" type="text"
                                           class="form-control @error('catalog_name') is-invalid @enderror"
                                           name="catalog_name" value="{{ old('catalog_name') }}" required>

                                    @error('catalog_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Add Catalog</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
@endsection
