@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Genre List</h1>
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#reportModal">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </button>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="font-weight-bold text-primary m-0 float-left">Genre Table View</h6>
            <a href="{{ route('add_genre') }}" class="btn btn-success float-right"><i class="fas fa-plus fa-sm text-white-100"></i> Add Genre</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif 
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th width="20">No</th>
                            <th>Genre Name</th>
                            <th width="30">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($genres as $no => $genre)
                        <tr>
                            <td width="20" class="text-center">{{ $no + 1 }}</td>
                            <td>{{ $genre->name }}</td>
                            <td width="30">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $genre->id }}">
                                        <i class="fas fa-trash fa-sm text-white-100"></i>
                                    </button>
                                    <a href="{{ route('edit_genre', $genre->id) }}" class="btn btn-info">
                                        <i class="fas fa-edit fa-sm text-white-100"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $genre->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $genre->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $genre->id }}">Delete This Genre</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure want to delete {{ $genre->name }} genre ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ route('delete_genre', $genre->id) }}" method="POST">
                                            @csrf 
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Report Generation Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel">
                    <i class="fas fa-download text-primary"></i> Generate Genre Report
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('generate_genre_report') }}" method="GET" target="_blank">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Report Type</label>
                        <select class="form-control" name="report_type" id="report_type">
                            <option value="all" selected>All Genres</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Page Orientation</label>
                        <select class="form-control" name="orientation">
                            <option value="landscape" selected>Landscape</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-download"></i> Generate PDF
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 