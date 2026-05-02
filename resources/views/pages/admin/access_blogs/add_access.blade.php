@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Blog</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Access 
        </a>
    </div>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Add Blog</h6>
        </div>
        <div class="card-body">
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="blog_id">Blog Title <span class="text-danger">*</span></label>
                    <select class="form-control is-invalid" id="blog_id" name="blog_id">
                        <option value="">Choose Blog</option>
                        <option value="#"> 
                            #
                        </option>
                        <option value="#"> 
                            #
                        </option>
                    </select>
                    <div class="invalid-feedback">
                        #
                    </div>
                    <small class="text-muted">Only blogs without access level will be shown.</small>
                </div>
                
                <div class="form-group">
                    <label for="access">Blog Access <span class="text-danger">*</span></label>
                    <select class="form-control is-invalid" id="access" name="access">
                        <option value="#">Choose Blog Access</option>
                        <option value="BASIC">BASIC - Rp 10.000</option>
                        <option value="PREMIUM">PREMIUM - Rp 15.000</option>
                        <option value="VIP">VIP - 20.000</option>
                    </select>
                    <div class="invalid-feedback">
                        #
                    </div> 
                </div>

                <!-- Field Price (Hidden or Disabled) -->
                <div class="form-group">
                    <label for="price">Price <span class="text-danger">*</span></label>
                    <input type="number" class="form-control invalid" id="price" name="price" value="#" placeholder="Price will be filled automatically based on access level" readonly>
                    <div class="invalid-feedback">
                        #
                    </div>
                    <small class="text-muted">Price is automatically set based on access level.</small>
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