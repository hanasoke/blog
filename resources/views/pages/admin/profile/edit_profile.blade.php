@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admin Profile</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Edit Admin Profile</h6>
        </div>
        <div class="card-body">
            <form action="#">
                <div class="form-group row">
                    <label for="full_name" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="full_name" value="#">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" value="#">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" value="#">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="phone" value="#">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" value="#">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="birthdate" class="col-sm-2 col-form-label">Birthdate</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="birthdate" value="#">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="birthdate" class="col-sm-2 col-form-label">Birthdate</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="birthdate" value="#">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="roles" class="col-sm-2 col-form-label">Roles</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="roles" value="#">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="access" class="col-sm-2 col-form-label">Access</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="access" value="#">
                    </div>
                </div>
                <div class="float-right">
                    <button class="btn btn-success">Submit</button>
                </div>
            </form>
            <div class="float-left">
                <a href="{{ route('admin_profile') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 