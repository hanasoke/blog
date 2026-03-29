@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Users List</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="font-weight-bold text-primary m-0">Users Table View</h6>
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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th width="20">No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Access</th>
                            <th>Picture</th>
                            <th width="20">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user) 
                            <tr>
                                <td class="text-center">
                                    {{ $index + 1 }}
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($user->birthdate)->age }} tahun
                                </td>
                                <td>
                                    {{ $user->access }}
                                </td>
                                <td class="text-center">
                                    @if($user->photo)
                                        <img src="{{ asset('storage/'.$user->photo) }}" width="100" class="rounded" alt="{{ $user->username }}">
                                    @else 
                                        -
                                    @endif 
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" 
                                            class="btn btn-success btn-view" 
                                            data-toggle="modal" 
                                            data-target="#viewModal{{ $user->id }}"
                                        >
                                            <i class="fas fa-eye fa-sm"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal{{ $user->id }}">
                                            <i class="fas fa-edit fa-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $user->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel{{ $user->id }}">Detail {{ $user->username }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label for="name{{ $user->id }}" class="col-sm-3 col-form-label font-weight-bold">Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-plaintext" id="name{{ $user->id }}" value="{{ $user->name }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="username{{ $user->id }}" class="col-sm-3 col-form-label font-weight-bold">Username</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-plaintext" id="username{{ $user->id }}" value="{{ $user->username }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email{{ $user->id }}" class="col-sm-3 col-form-label font-weight-bold">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-plaintext" id="email{{ $user->id }}" value="{{ $user->email }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone{{ $user->id }}" class="col-sm-3 col-form-label font-weight-bold">Phone</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-plaintext" id="phone{{ $user->id }}" value="{{ $user->phone }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="birthdate{{ $user->id }}" class="col-sm-3 col-form-label font-weight-bold">Birthdate</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-plaintext" id="birthdate{{ $user->id }}" value="{{ \Carbon\Carbon::parse($user->birthdate)->format('d F Y') }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="age{{ $user->id }}" class="col-sm-3 col-form-label font-weight-bold">Age</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-plaintext" id="age{{ $user->id }}" value="{{ \Carbon\Carbon::parse($user->birthdate)->age }} tahun">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="roles{{ $user->id }}" class="col-sm-3 col-form-label font-weight-bold">Roles</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-plaintext" id="roles{{ $user->id }}" value="{{ $user->roles }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="access{{ $user->id }}" class="col-sm-3 col-form-label font-weight-bold">Access</label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-plaintext" id="access{{ $user->id }}" value="{{ $user->access }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label font-weight-bold">Photo</label>
                                                <div class="col-sm-9">
                                                    @if($user->photo)
                                                        <img src="{{ asset('storage/'.$user->photo) }}" class="img-thumbnail" width="150" alt="{{ $user->username }}">
                                                    @else
                                                        <p class="text-muted">No photo available</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User: {{ $user->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('update_user_access', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="access{{ $user->id }}">Access Level</label>
                                                    <select class="form-control" id="access{{ $user->id }}" name="access">
                                                        <option value="FREE" {{ $user->access == 'FREE' ? 'selected' : '' }}>FREE</option>
                                                        <option value="STANDARD" {{ $user->access == 'STANDARD' ? 'selected' : '' }}>STANDARD</option>
                                                        <option value="PREMIUM" {{ $user->access == 'PREMIUM' ? 'selected' : '' }}>PREMIUM</option>
                                                        <option value="PROFESSIONAL" {{ $user->access == 'PROFESSIONAL' ? 'selected' : '' }}>PROFESSIONAL</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
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