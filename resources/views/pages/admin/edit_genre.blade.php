@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Genre</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Edit Genre</h6>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="blog_title">Genre Name</label>
                    <input type="text" class="form-control is-invalid" id="blog_title" placeholder="Input Blog Title" aria-describedby="validationServer03Feedback">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        Please Type Genre Name
                    </div>
                </div>
                <button class="btn btn-success btn-lg btn-block">Submit</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 