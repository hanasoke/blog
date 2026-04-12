@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Access Blogs</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </a>
    </div>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="font-weight-bold text-primary m-0 float-left">Access Blogs Table View</h4>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th width="10">No</th>
                            <th>Blog Title</th>
                            <th>Genre</th>
                            <th>Source</th>
                            <th>Access Level</th>
                            <th>Status</th>
                            <th>Published Date</th>
                            <th width="30">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $index => $blog)
                        <tr>
                            <td class="text-center">
                                {{ $index + 1}}
                            </td>
                            <td>
                                {{ Str::limit($blog->title, 50) }}
                            </td>
                            <td>
                                <span class="badge badge-info p-2">{{ $blog->genre->name ?? '-' }}</span>
                            </td>
                            <td>
                                {{ $blog->source->name ?? '-' }}
                            </td>
                            <td class="text-center">
                                @php 
                                    $badgeClass = '';
                                    $accessLevel = $blog->access->access ?? 'NO Access';
                                    switch($accessLevel) {
                                        case 'BASIC':
                                            $badgeClass = 'badge-success';
                                            break; 
                                        case 'PREMIUM':
                                            $badgeClass = 'badge-warning';
                                            break;
                                        case 'VIP': 
                                            $badgeClass = 'badge-primary';
                                            break;
                                        default:
                                            $badgeClass = 'badge-secondary';
                                    }
                                @endphp 
                                <span class="badge {{ $badgeClass }} p-2">{{ $accessLevel }}</span>
                            </td>
                            <td class="text-center">
                                @if($blog->access)
                                    <span class="badge badge-success p-2">Published</span>
                                @else
                                    <span class="badge badge-warning p-2">Draft (No Access)</span>
                                @endif
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($blog->created_at)->format('d F Y') }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewModal{{ $blog->id }}">
                                        <i class="fas fa-eye fa-sm text-white-100"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Detail Modal -->
                        <div class="modal fade" id="viewModal{{ $blog->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $blog->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel{{ $blog->id }}">
                                            View Article Detail
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Blog Title</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    #
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Thumbnail</label>
                                            <div class="col-sm-8">
                                                    <img src="#" class="img-thumbnail" alt="#" width="200"> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Source</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    #
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Genre</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    #
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Access</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    #
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Description</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    #
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Published</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    #
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty 
                        <tr>
                            <td colspan="8" class="text-center">No Articles found.</td>
                        </tr>    
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection 