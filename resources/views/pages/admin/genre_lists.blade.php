@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Genre List</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Genre Table List</h6>
            <a href="{{ route('add_genre') }}" class="btn btn-success float-right"><i class="fas fa-plus fa-sm text-white-100"></i> Add Genre</a>
        </div>
        <div class="card-body">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>A Genre has been added</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th width="20">No</th>
                            <th>Genre Name</th>
                            <th width="30">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="20" class="text-center">1</td>
                            <td>Comedy</td>
                            <td width="30">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fas fa-trash fa-sm text-white-100"></i>
                                    </button>
                                    <a href="{{ route('edit_genre') }}" class="btn btn-info">
                                        <i class="fas fa-edit fa-sm text-white-100"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="20" class="text-center">2</td>
                            <td>Technology</td>
                            <td width="30">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fas fa-trash fa-sm text-white-100"></i>
                                    </button>
                                    <a href="{{ route('edit_genre') }}" class="btn btn-info">
                                        <i class="fas fa-edit fa-sm text-white-100"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="20" class="text-center">3</td>
                            <td>Romance</td>
                            <td width="30">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fas fa-trash fa-sm text-white-100"></i>
                                    </button>
                                    <a href="{{ route('edit_genre') }}" class="btn btn-info">
                                        <i class="fas fa-edit fa-sm text-white-100"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete This Genre</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure want to delete {name} genre ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 