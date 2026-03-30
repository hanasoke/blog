@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">Add Edit Source</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Edit Source</h6>
        </div>
        <div class="card-body">
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="source_name">Source Name</label>
                    <input type="text" name="name" class="form-control is-invalid" id="source_name" value="#">
                    <div class="invalid-feedback">
                        #
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block">Update</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 