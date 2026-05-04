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
            <a href="{{ route('add_access') }}" class="btn btn-success float-right"><i class="fas fa-plus fa-sm text-white-100"></i> Add Access Blog</a>
        </div>
        <div class="card-body">
            <!-- Alert Success -->
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
                    <thead>
                        <tr>
                            <th width="10" class="text-center">NO</th>
                            <th>Blog Title</th>
                            <th class="text-center">Access</th>
                            <th class="text-center">Price</th>
                            <th>Created At</th>
                            <th width="100" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($accessBlogs as $index => $access)
                            <tr>
                                <td class="text-center">
                                    {{ $index + 1 }}
                                </td>
                                <td>
                                    <strong>{{ $access->blog->title ?? 'Unknown' }}</strong>
                                </td>
                                <td class="text-center">
                                    @php 
                                        $badgeClass = '';
                                        switch($access->member->name ?? '') {
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
                                    <span class="badge p-2 {{ $badgeClass }}">
                                        {{ $access->member->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    Rp {{ number_format($access->member->price ?? 0, 0, ',', '.') }}
                                </td>
                                <td>
                                    {{ $access->created_at ? $access->created_at->format('d M Y H:i') : 'N/A' }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                            <i class="fas fa-trash fa-sm"></i>
                                        </button>
                                        <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#viewModal{{ $access->id }}"><i class="fas fa-eye fa-sm text-white-100"></i></button>
                                        <a href="{{ route('edit_access', $access->id) }}" class="btn btn-success">
                                            <i class="fas fa-edit fa-sm text-white-100"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty 
                            <tr>
                                <td colspan="6" class="text-center">No access blogs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@foreach($accessBlogs as $access)

<!-- Detail Modal -->
<div class="modal fade" id="viewModal{{ $access->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $access->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel{{ $access->id }}">
                    Detail : <b>{{ $access->blog->title ?? 'Unknown' }}</b>
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
                            {{ $access->blog->title ?? 'Unknown' }}
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
                            {{ $access->blog->source->name ?? 'Unknown' }}
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Genre</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">
                            {{ $access->blog->genre->name ?? 'Unknown' }}
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Access</label>
                    <div class="col-sm-8">
                        @php 
                            $badgeClass = '';
                            switch($access->member->name ?? '') {
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
                        <p class="form-control-plaintext">
                            <span class="badge p-2 {{ $badgeClass }}">
                                {{ $access->member->name ?? 'N/A' }}
                            </span>
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    Delete <b>#</b> Article
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure want to delete access <b>Access Name</b> for blog <b> Blog Title</b>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
@endforeach 

@endsection 