@extends('layouts.manage')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">User Profile</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Username</label>
                                    <input type="text" class="form-control" value="{{ $username }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Role (1 - Customer, 2 - Admin, 3 - Editor)</label>
                                    <input type="text" class="form-control" value="{{ $role_id }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Email</label>
                                    <input type="text" class="form-control" value="{{ $email }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Phone Number</label>
                                    <input type="text" class="form-control" value="{{ $phone_number }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Full Name</label>
                                    <input type="text" class="form-control" value="{{ $real_name }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Adress</label>
                                    <input type="text" class="form-control" value="{{ $address }}" disabled>
                                </div>
                            </div>
                        </div>
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
                    <h6 class="card-category text-gray">{{ $role }}</h6>
                    <h4 class="card-title">{{ $real_name }}</h4>
                </div>
            </div>
        </div>
@endsection
