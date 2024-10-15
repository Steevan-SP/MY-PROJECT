@extends('layouts.admin.master')
@section('title','User List')
@section('header','Users')
@section('content')


    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Details</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form>
                        <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->Role->name }}">
                                </div>
                        </div>
                        @if($user->role->name == 'Admin')
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->admin->firstname }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->admin->lastname }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->admin->address }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Landline</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->admin->landline }}">
                                </div>
                            </div>
                            @else
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->receptionist->firstname }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->receptionist->lastname }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->receptionist->address }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Landline</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->receptionist->landline }}">
                                </div>
                            </div>
                        @endif
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">National ID Number</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->id_number }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->phone }}">
                                </div>
                            </div>  
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">EPF Number</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly="" class="form-control" value="{{ $user->epfnumber }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-9">
                                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection