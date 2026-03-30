@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Source List</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="font-weight-bold text-primary m-0 float-left">Source Table View</h6>
            <a href="#" class="btn btn-success float-right"><i class="fas fa-plus fa-sm text-white-100"></i> Add Source</a>
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
                            <th>Source Name</th>
                            <th width="30">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="20" class="text-center">1</td>
                            <td>CNN</td>
                            <td width="30">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                        <i class="fas fa-trash fa-sm text-white-100"></i>
                                    </button>
                                    <a href="#" class="btn btn-info">
                                        <i class="fas fa-edit fa-sm text-white-100"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Delete This Genre</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure want to delete this source ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="#" method="POST">
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
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