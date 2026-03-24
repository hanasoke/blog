@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Blog</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Edit Blog</h6>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="blog_title">Blog Title</label>
                    <input type="text" class="form-control" id="blog_title" placeholder="Edit Blog Title">
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <select class="form-control" id="genre">
                        <option value="#">Choose Genre</option>
                        <option>Romance</option>
                        <option>Politic</option>
                        <option>Geograpy</option>
                        <option>Paleontologi</option>
                        <option>Economic</option>
                        <option>Sports</option>
                        <option>Education</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" rows="3"></textarea>
                </div>
                <button class="btn btn-success btn-lg btn-block">Submit</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 