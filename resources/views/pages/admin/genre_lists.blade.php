@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Genre List</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Genre Table List</h6>
            <a href="{{ route('add_genre') }}" class="btn btn-success float-right"><i class="fas fa-plus fa-sm text-white-100"></i> Add Genre</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20" class="text-center">No</th>
                            <th>Genre Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="20" class="text-center">1</td>
                            <td>Comedy</td>
                        </tr>
                        <tr>
                            <td width="20" class="text-center">2</td>
                            <td>Technology</td>
                        </tr>
                        <tr>
                            <td width="20" class="text-center">3</td>
                            <td>Romance</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 