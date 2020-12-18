@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Edit Profile</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Company (disabled)</label>
                                    <input type="text" class="form-control" value="{{ config('app.name', 'Laravel') }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Username (disabled)</label>
                                    <input type="text" class="form-control" value="{{ $username }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email }}" required autofocus>

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
                                    <input type="text" name="real_name" class="form-control" value="{{ $real_name }}">
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
                        <div class="clearfix"></div>
                    </form>
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
                    <h6 class="card-category text-gray">{{ $userTitle }}</h6>
                    <h4 class="card-title">{{ $real_name }}</h4>
                </div>
            </div>
        </div>
@endsection
