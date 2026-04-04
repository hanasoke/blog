@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Blogs</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="font-weight-bold text-primary m-0 float-left">Blogs Table View</h4>
            <a href="{{ route('add_blog') }}" class="btn btn-success float-right"><i class="fas fa-plus fa-sm text-white-100"></i> Add Blog</a>
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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Judul Blog</th>
                            <th>Genre</th>
                            <th>Tanggal Terbit</th>
                            <th>Source</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $index => $blog)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->genre->name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($blog->created_at)->format('d F Y') }}</td>
                                <td>{{ $blog->source->name ?? '-' }}</td>
                                <td>
                                    {{ $blog->description }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $blog->id }}"><i class="fas fa-trash fa-sm text-white-100"></i></button>
                                        <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#viewModal{{ $blog->id }}"><i class="fas fa-eye fa-sm text-white-100"></i></button>
                                        <a href="{{ route('edit_blog', $blog->id) }}" class="btn btn-success"><i class="fas fa-edit fa-sm text-white-100"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $blog->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $blog->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $blog->id }}">Delete Blog</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            <b>Are you sure want to delete "{{ $blog->title }}" article ?</b>
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <form action="{{ route('delete_blog', $blog->id) }}" method="POST" style="display: inline;">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Modal -->
                            <div class="modal fade" id="viewModal{{ $blog->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $blog->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel{{ $blog->id }}">View Detail {{ $blog->title }} Article</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Blog Title</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext" id="title">{{ $blog->title }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Published</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($blog->created_at)->format('d F Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="source" class="col-sm-4 col-form-label">Source</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">{{ $blog->source->name ?? '-' }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Tanggal Edit</label>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">
                                                    {{ $blog->updated_at ? \Carbon\Carbon::parse($blog->updated_at)->format('d F Y H:i') : 'Belum di Edit' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="thumbnail" class="col-sm-4 col-form-label">Thumbnail</label>
                                            <div class="col-sm-8">
                                                <img src="{{ asset('storage/'.$blog->thumbnail) }}" class="img-thumbnail" alt="{{ $blog->title }}" width="200" id="thumbnail" >
                                            </div>
                                        </div>
                                        @if($blog->image_2)
                                            <div class="form-group row">
                                                <label for="image_2" class="col-sm-4 col-form-label">Image 2</label>
                                                <div class="col-sm-8">
                                                    <img src="{{ asset('storage/'.$blog->image_2) }}" class="img-thumbnail" alt="{{ $blog->title }}" width="200" id="image_2">
                                                </div>
                                            </div>
                                        @endif 
                                        @if($blog->image_3) 
                                            <div class="form-group row">
                                                <label for="image_3" class="col-sm-4 col-form-label">Image 3</label>
                                                <div class="col-sm-8">
                                                    <img src="{{ asset('storage/'.$blog->image_3) }}" class="img-thumbnail" alt="{{ $blog->title }}" width="200" id="image_3">
                                                </div>
                                            </div>
                                        @endif 
                                        <div class="form-group row">
                                            <div class="col-sm-4 col-form-label font-weight-bold">Description</div>
                                            <div class="col-sm-8">
                                                <p class="form-control-plaintext">{{$blog->description}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        <div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 