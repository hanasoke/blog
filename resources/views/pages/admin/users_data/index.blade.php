@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Users List</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="font-weight-bold text-primary m-0">Users Table List</h6>
        </div>
        <div class="card-body">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>#</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th width="20">No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Access</th>
                            <th>Picture</th>
                            <th width="20">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user) 
                            <tr>
                                <td class="text-center">
                                    {{ $index + 1 }}
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($user->birthdate)->age }} tahun
                                </td>
                                <td>
                                    {{ $user->access }}
                                </td>
                                <td class="text-center">
                                    @if($user->photo)
                                        <img src="{{ asset('storage/'.$user->photo) }}" width="100" class="rounded" alt="{{ $user->username }}">
                                    @else 
                                        -
                                    @endif 
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-danger">
                                            <i class="fas fa-trash fa-sm text-white-100"></i>
                                        </button>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#viewModal">
                                            <i class="fas fa-eye fa-sm text-white-100"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary">
                                            <i class="fas fa-edit fa-sm text-white-100"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel">Detail Modal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" id="name" value="#">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" id="username" value="#">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" id="email" value="#">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" id="phone" value="#">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="birthdate" class="col-sm-3 col-form-label">Birtdate</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" id="birthdate" value="#">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="age" class="col-sm-3 col-form-label">Age</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" id="age" value="#">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="roles" class="col-sm-3 col-form-label">Roles</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" id="roles" value="#">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="access" class="col-sm-3 col-form-label">Access</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" id="access" value="#">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="access" class="col-sm-3 col-form-label">Photo</label>
                                            <div class="col-sm-9">
                                                <img src="#" class="img-thumbnail" alt="#">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 