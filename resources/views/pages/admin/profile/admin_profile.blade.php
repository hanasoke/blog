@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admin Profile</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif 

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Admin Profile Detail</h6>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="full_name" class="col-sm-2 col-form-label">Full Name</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="full_name" value="{{ $admin->name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="username" value="{{ $admin->username }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="email" value="{{ $admin->email }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="phone" value="{{ $admin->phone }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="birthdate" class="col-sm-2 col-form-label">Birthdate</label>
                <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="birthdate" value="{{ $admin->birthdate->format('d M Y') }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="roles" class="col-sm-2 col-form-label">Roles</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="roles" value="{{ $admin->roles }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="access" class="col-sm-2 col-form-label">Access</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="access" value="{{ $admin->access }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="picture" class="col-sm-2 col-form-label">Picture</label>
                <div class="col-sm-10">
                    <img src="{{ asset('storage/' . $admin->photo) }}" id="picture" class="img-thumbnail" width="150" alt="{{ $admin->username }}">
                </div>
            </div>
            <div class="float-right">
                <a href="{{ route('edit_profile') }}" class="btn btn-info">Edit</a>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 