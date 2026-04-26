@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Transaction</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Pending Transaction  
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Edit Blog</h6>
        </div>
        <div class="card-body">
            <form action="#" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="title">Blog Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control is-invalid" id="title" name="title" placeholder="Edit Blog Title" value="#">
                        <div class="invalid-feedback">
                            #
                        </div>
                </div>
                <div class="form-group">
                    <label for="genre_id">Genre <span class="text-danger">*</span></label>
                    <select class="form-control @error('genre_id') is-invalid @enderror" id="genre_id" name="genre_id">
                        <option value="">Choose Genre</option>
                        <option value="#">
                            #
                        </option>
                    </select>
                </div>

                <!-- Current Thumbnail Preview -->
                <div class="form-group">
                    <label>Current Thumbnail</label>
                    <div>
                        <img src="#" alt="#" class="img-thumbnail" width="200">
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fas fa-save"></i> Update Blog</button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection 