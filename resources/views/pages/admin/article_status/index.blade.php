@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Access Blogs</h1>
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#reportModal">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </button>
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
                                    $accessLevel = $blog->access->member->name ?? 'NO Access';
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
                                            Article Detail : {{ Str::limit($blog->title, 50) }}
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
                                                    {{ $blog->title }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Genre</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    {{ $blog->genre->name ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Source</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    {{ $blog->source->name ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Access Level</label>
                                            <div class="col-sm-8">
                                                @php 
                                                    $badgeClass = '';
                                                    $accessLevel = $blog->access->member->name ?? 'NO Access';
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
                                                <p class="form-control-plaintext">
                                                    <span class="badge {{ $badgeClass }}">{{ $accessLevel }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Status</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    @if($blog->access)
                                                        <span class="badge badge-success">Published</span>
                                                    @else
                                                        <span class="badge badge-warning">Draft</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Thumbnail</label>
                                            <div class="col-sm-8">
                                                    <img src="{{ asset('storage/'.$blog->thumbnail) }}" class="img-thumbnail" alt="{{ $blog->title }}" width="100%"> 
                                            </div>
                                        </div>

                                        @if($blog->image_2)
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Image 2</label>
                                                <div class="col-sm-8">
                                                        <img src="{{ asset('storage/'.$blog->image_2) }}" class="img-thumbnail" alt="{{ $blog->title }}" width="100%"> 
                                                </div>
                                            </div>
                                        @endif

                                        @if($blog->image_3)
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Image 3</label>
                                                <div class="col-sm-8">
                                                        <img src="{{ asset('storage/'.$blog->image_3) }}" class="img-thumbnail" alt="{{ $blog->title }}" width="100%"> 
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Description</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    {{ $blog->description }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Published</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    {{ \Carbon\Carbon::parse($blog->created_at)->format('d F Y H:i') }}
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

                        <!-- Report Generation Modal -->
                        <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reportModalLabel">
                                            <i class="fas fa-download text-primary"></i> Generate Blog Report
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('generate_blogs_report') }}" method="GET" target="_blank">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Report Type <span class="text-danger">*</span></label>
                                                <select class="form-control" name="report_type" id="report_type" required>
                                                    <option value="all">All Blogs</option>
                                                    <option value="date_range">By Date Range</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group" id="date_range_fields" style="display: none;">
                                                <label>Start Date <span class="text-danger">*</span></label>
                                                <input type="date" name="start_date" class="form-control">
                                                <br>
                                                <label>End Date <span class="text-danger">*</span></label>
                                                <input type="date" name="end_date" class="form-control">
                                                <small class="text-muted">Filter blogs by creation date</small>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Page Orientation <span class="text-danger">*</span></label>
                                                <select class="form-control" name="orientation" required>
                                                    <option value="portrait">Portrait</option>
                                                    <option value="landscape" selected>Landscape (Recommended)</option>
                                                </select>
                                            </div>
                                            
                                            <div class="alert alert-info mt-3">
                                                <i class="fas fa-info-circle"></i>
                                                <strong>Info:</strong> The report will include all blog posts with their genre, source, author, and access level information.
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