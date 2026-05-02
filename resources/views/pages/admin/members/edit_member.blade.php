@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Member</h1>
        <a href="{{ route('members') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Member Lists
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Edit Member</h6>
        </div>
        <div class="card-body">
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="member_grade">Member Grade</label>
                    <input 
                        type="text"
                        name="name" 
                        class="form-control is-invalid" 
                        value="#" 
                        id="member_grade" placeholder="Input Member Grade">

                        <div class="invalid-feedback">
                            #
                        </div>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input 
                        type="text"
                        name="price" 
                        class="form-control is-invalid" 
                        value="#" 
                        id="genre_title" placeholder="Input Your Genre Name">
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