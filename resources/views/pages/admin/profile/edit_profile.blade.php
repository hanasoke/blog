@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admin Profile</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Edit Admin Profile</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('update_profile') }}" method="POST"  enctype="multipart/form-data">
                @csrf 
                <!-- Full Name -->
                <div class="form-group row">
                    <label for="full_name" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control is-invalid" id="full_name" value="{{ old('name', $admin->name) }}">
                        <div class="invalid-feedback">
                            error 
                        </div>
                    </div>
                </div>

                <!-- Username -->
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control is-invalid" id="username" value="{{ old('username', $admin->username) }}">
                        <div class="invalid-feedback">
                            error 
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control is-invalid" id="email" value="{{ old('email', $admin->email) }}">
                        <div class="invalid-feedback">
                            error 
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" name="phone" class="form-control is-invalid" id="phone" value="{{ old('phone', $admin->phone) }}">
                        <div class="invalid-feedback">
                            error 
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="birthdate" class="col-sm-2 col-form-label">Birthdate</label>
                    <div class="col-sm-10">
                        <input type="date" name="birthdate" class="form-control is-invalid" id="birthdate" value="{{ old('birthdate', $admin->birthdate->format('Y-m-d')) }}">
                        <div class="invalid-feedback">
                            error 
                        </div>
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
                    <label for="upload_picture" class="col-sm-2 col-form-label">Picture</label>
                    <div class="col-sm-10">
                        <img src="{{ asset('storage/'.$admin->photo) }}" id="upload_picture" class="img-thumbnail" alt="{{ $admin->username }}" width="150">
                        <div class="input-group my-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" for="upload_picture">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="photo" class="custom-file-input is-invalid" id="upload_picture">
                                <label class="custom-file-label" for="upload_picture">Choose file</label>
                            </div>
                            <div class="invalid-feedback">
                                error 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-success">Update</button>
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