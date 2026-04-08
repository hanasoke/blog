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
            <a href="{{ route('add_access') }}" class="btn btn-success float-right"><i class="fas fa-plus fa-sm text-white-100"></i> Add Access Blog</a>
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
                        <tr class="text-center">
                            <th width="10">NO</th>
                            <th>Judul Blog</th>
                            <th>Access</th>
                            <th width="30">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td>Langgeng Bareng Pasangan</td>
                            <td>Free</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye fa-sm text-white-100"></i></button>
                                    <a href="#" class="btn btn-success"><i class="fas fa-edit fa-sm text-white-100"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>Perempuan Jago Masak</td>
                            <td>Basic</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye fa-sm text-white-100"></i></button>
                                    <a href="#" class="btn btn-success"><i class="fas fa-edit fa-sm text-white-100"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>Perempuan Bisa Mengendarai Mobil</td>
                            <td>Premium</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye fa-sm text-white-100"></i></button>
                                    <a href="#" class="btn btn-success"><i class="fas fa-edit fa-sm text-white-100"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td>Perempuan Mandiri Secara Finansial</td>
                            <td>VIP</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye fa-sm text-white-100"></i></button>
                                    <a href="#" class="btn btn-success"><i class="fas fa-edit fa-sm text-white-100"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">View Detail <b></b> Article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Blog Title</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext" id="title">#</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection 