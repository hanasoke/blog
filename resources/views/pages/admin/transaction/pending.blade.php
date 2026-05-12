@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pending Transaction</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="font-weight-bold text-primary m-0 float-left">Pending Transaction</h4>
        </div>
        <div class="card-body">
            <!-- Alert Success -->
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Alert Error -->
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Username</th>
                            <th>Wallet Name</th>
                            <th>Payment Proof</th>
                            <th>Payment Number</th>
                            <th>Payment Status</th>
                            <th>Requested Member</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>#</td>
                            <td>
                                #
                            </td>
                            <td>
                                #
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye fa-sm text-white-100"></i></button>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit fa-sm text-white-100"></i></button>
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
                <h5 class="modal-title" id="viewModalLabel"><b>#</b></h5>
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
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Published</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">#</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="source" class="col-sm-4 col-form-label">Source</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">#</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tanggal Edit</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">
                            #
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="thumbnail" class="col-sm-4 col-form-label">Thumbnail</label>
                    <div class="col-sm-8">
                        <img src="#" class="img-thumbnail" alt="#" width="200" id="thumbnail" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image_2" class="col-sm-4 col-form-label">Image 2</label>
                    <div class="col-sm-8">
                        <img src="#" class="img-thumbnail" alt="#" width="200" id="image_2">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="image_3" class="col-sm-4 col-form-label">Image 3</label>
                    <div class="col-sm-8">
                        <img src="#" class="img-thumbnail" alt="#" width="200" id="image_3">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4 col-form-label font-weight-bold">Description</div>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">#</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Author</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">#</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><b>Edit Transaction</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">username</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">#</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">email</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">#</p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4 col-form-label">Wallet Name</div>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">#</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Payment Proof</label>
                    <div class="col-sm-8">
                        <img src="#" class="img-thumbnail" alt="#" width="200" id="thumbnail">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4 col-form-label">Account Number</div>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">#</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="message" class="col-sm-4 col-form-label">Message</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="message">
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