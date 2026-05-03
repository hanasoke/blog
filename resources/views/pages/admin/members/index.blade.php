@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Members Grade</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="font-weight-bold text-primary m-0 float-left">Members Table View</h6>
            <a href="{{ route('add_member') }}" class="btn btn-success float-right"><i class="fas fa-plus fa-sm text-white-100"></i> Add Member</a>
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
                            <th>Membership Grade</th>
                            <th>Price</th>
                            <th width="30">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $no => $member)
                        <tr>
                            <td width="20" class="text-center">{{ $no + 1 }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->price }}</td>
                            <td width="30">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $member->id }}">
                                        <i class="fas fa-trash fa-sm text-white-100"></i>
                                    </button>
                                    <a href="{{ route('edit_member', $member->id) }}" class="btn btn-info">
                                        <i class="fas fa-edit fa-sm text-white-100"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $member->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $member->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $member->id }}">Delete This Membership Grade</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure want to delete {{ $member->name }} ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ route('delete_member', $member->id) }}" method="POST">
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
@endsection 