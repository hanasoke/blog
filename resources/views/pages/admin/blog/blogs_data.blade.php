@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Blogs</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="font-weight-bold text-primary m-0 float-left">Blogs Table View</h4>
            <a href="{{ route('add_blog') }}" class="btn btn-success float-right"><i class="fas fa-plus fa-sm text-white-100"></i> Add Blog</a>
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
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Judul Blog</th>
                            <th>Tanggal Terbit</th>
                            <th>Source</th>
                            <th>Tanggal Edit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Papua Merupakan Bagian dari Indonesia</td>
                            <td>27 Maret 2026</td>
                            <td>New York Times</td>
                            <td>Belum di Edit</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash fa-sm text-white-100"></i></button>
                                    <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye fa-sm text-white-100"></i></button>
                                    <a href="{{ route('edit_blog') }}" class="btn btn-success"><i class="fas fa-edit fa-sm text-white-100"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Blog</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>
                                <b>Are you sure want to delete {blog_name} article ?</b>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Modal -->
                <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewModalLabel">View Detail {blog_name} Article</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group row">
                                    <label for="title" class="col-sm-4 col-form-label">Blog Title</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="title" value="blog_title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="published_date" class="col-sm-4 col-form-label">Published</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="published_date" value="27 March 2026">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="source" class="col-sm-4 col-form-label">Source</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="source" value="source">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_edit" class="col-sm-4 col-form-label">Tanggal Edit</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="tanggal_edit" value="Belum di Edit">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="thumbnail" class="col-sm-4 col-form-label">Thumbnail</label>
                                    <div class="col-sm-8">
                                        <img src="..." class="img-thumbnail" alt="...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="thumbnail" class="col-sm-4 col-form-label">Image 2</label>
                                    <div class="col-sm-8">
                                        <img src="..." class="img-thumbnail" alt="...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="thumbnail" class="col-sm-4 col-form-label">Image 3</label>
                                    <div class="col-sm-8">
                                        <img src="..." class="img-thumbnail" alt="...">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 