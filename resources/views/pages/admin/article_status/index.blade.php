@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Access Blogs</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </a>
    </div>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="font-weight-bold text-primary m-0 float-left">Access Blogs Table View</h4>
            <a href="#" class="btn btn-success float-right"><i class="fas fa-plus fa-sm text-white-100"></i> Add Access Blog</a>
        </div>
        <div class="card-body">
            <!-- Alert Success -->
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>#</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="10" class="text-center">NO</th>
                            <th>Judul Blog</th>
                            <th class="text-center">Access</th>
                            <th>Created At</th>
                            <th width="30" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                #
                            </td>
                            <td>
                                #
                            </td>
                            <td class="text-center">
                                <span class="badge badge-success p-2">#</span>
                            </td>
                            <td>
                                #
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#"><i class="fas fa-eye fa-sm text-white-100"></i></button>
                                    <a href="#" class="btn btn-success">
                                        <i class="fas fa-edit fa-sm text-white-100"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Detail Modal -->
                        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel">
                                            View Detail Article
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Blog Title</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    #
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Thumbnail</label>
                                            <div class="col-sm-8">
                                                    <img src="#" class="img-thumbnail" alt="#" width="200"> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Source</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    #
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Genre</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    #
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Published</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    #
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Access</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    #
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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