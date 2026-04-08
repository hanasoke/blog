@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Blog</h1>
        <a href="{{ route('access_blogs') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Access 
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Add Blog</h6>
        </div>
        <div class="card-body">
            <form action="#" method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="blog_title">Blog Title<span class="text-danger">*</span></label>
                    <select class="form-control" id="blog_title" name="blog_title">
                        <option value="">Choose Blog</option>
                        <option value="#">
                            #
                        </option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="blog_access">Blog Access<span class="text-danger">*</span></label>
                    <select class="form-control" id="blog_access" name="blog_access">
                        <option value="#">Choose Blog Access</option>
                            <option value="#">
                                #
                            </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success btn-lg btn-block">
                    <i class="fas fa-save"></i> Submit 
                </button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 