@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Edit User Profile</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.users.update', $id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Username (disabled)</label>
                                    <input type="text" class="form-control" value="{{ $username }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Role (1 - Customer, 2 - Admin, 3 - Editor)</label>
                                    <input id="role_id" type="text" class="form-control @error('role_id') is-invalid @enderror" name="role_id" value="{{ $role_id }}" required>

                                    @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email }}" required>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" value="{{ $phone_number }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Full Name</label>
                                    <input id="real_name" type="text" class="form-control @error('real_name') is-invalid @enderror" name="real_name" value="{{ $real_name }}" required>

                                    @error('real_name')
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
                                    <label class="bmd-label-floating">Adress</label>
                                    <input type="text" name="address" class="form-control" value="{{ $address }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Avatar Link</label>
                                    <input type="text" name="avatar" class="form-control" value="{{ $avatar }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Update Profile</button>

                        <button class="btn btn-primary pull-right" href="{{ route('admin.users.destroy', $id) }}"
                                onclick="event.preventDefault();
                                    document.getElementById('delete-form').submit({{$id}});">
                            {{ __('Delete') }}
                        </button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="form-group">
                        <h2>Order List</h2>
                    </div>
                </div>
                <div class="col-md-auto center" style="margin-left: auto; margin-right: auto;">
                    <div class="form-group">
                        @include('admin.users.partials.order-list')
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="javascript:;">
                        <img class="img" src="{{ $avatar }}" alt="img"/>
                    </a>
                </div>
                <div class="card-body">
                    <h6 class="card-category text-gray">{{ $role }}</h6>
                    <h4 class="card-title">{{ $real_name }}</h4>
                </div>
            </div>
        </div>


        <form id="delete-form" action="{{ route('admin.users.destroy', $id) }}" method="POST"
              class="d-none">
            @csrf
            @method('DELETE')
        </form>
@endsection
