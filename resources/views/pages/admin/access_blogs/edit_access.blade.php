@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Access Blog</h1>
        <a href="{{ route('access_blogs') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Access 
        </a>
    </div>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Edit Access: {{ $accessBlog->blog->title }}</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('update_access', $accessBlog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf 
                @method('PUT')

                <div class="form-group">
                    <label for="blog_title">Blog Title <span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control"
                        id="blog_title"
                        name="blog_title"
                        value="{{ $accessBlog->blog->title }}"
                        readonly
                        disabled>
                    <small class="text-muted">
                        Blog title cannot be changed.
                    </small>
                    
                    <!-- Hidden input untuk mengirim blog_id ke server -->
                    <input type="hidden" name="blog_id" value="{{ $accessBlog->blog_id }}">
                </div>

                <div class="form-group">
                    <label for="access">Blog Access <span class="text-danger">*</span></label>
                    <select class="form-control @error('access') is-invalid @enderror" id="access" name="access">
                        <option value="">Choose Blog Access</option>
                        <option value="BASIC" {{ old('access', $accessBlog->access) == 'BASIC' ? 'selected' : '' }}>BASIC (Rp 10.000)</option>
                        <option value="PREMIUM" {{ old('access', $accessBlog->access) == 'PREMIUM' ? 'selected' : '' }}>PREMIUM (Rp 15.000)</option>
                        <option value="VIP" {{ old('access', $accessBlog->access) == 'VIP' ? 'selected' : '' }}>VIP (Rp 20.000)</option>
                    </select>
                    @error('access')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror 
                </div>

                <div class="form-group">
                    <label for="price">Price <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $accessBlog->price) }}" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                    <small class="text-muted">
                        Price is automatically set based on access level. 
                    </small>
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror 
                </div>

                <div class="form-group">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Price Details:</strong>
                        <ul class="mb-0 mt-2">
                            <li><strong>BASIC:</strong> Rp 10.000</li>
                            <li><strong>PREMIUM:</strong> Rp 15.000</li>
                            <li><strong>VIP:</strong> Rp 20.000</li>
                        </ul>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-lg btn-block">
                    <i class="fas fa-save"></i> Update
                </button>
            </form>
        </div>
    </div>
     
</div>
<!-- /.container-fluid -->
@endsection 
