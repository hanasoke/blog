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
            <form action="{{ route('update_access', $accessBlog->id) }}" method="POST">
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
                    <label for="member_id">Access Level<span class="text-danger">*</span></label>
                    <select class="form-control @error('member_id') is-invalid @enderror" id="member_id" name="member_id">
                        <option value="">Choose Access Level</option>
                        @foreach($members as $member) 
                            <option value="{{ $member->id }}" data-price="{{ $member->price }}" {{ old('member_id', $accessBlog->member_id) == $member->id ? 'selected' : '' }}>
                                {{ $member->name }} - Rp {{ number_format($member->price,0,',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('member_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div> 
                    @enderror 
                </div>

                <div class="form-group">
                    <label for="price_display">Price <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="text" class="form-control" id="price_display" value="{{ number_format($accessBlog->member->price, 0, ',', '.') }}" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                    <small class="text-muted">
                        Price is automatically set based on access level. 
                    </small>
                </div>

                <div class="form-group">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Access Level Details:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($members as $member)
                                <li><strong>{{ $member->name }}:</strong> Rp {{ number_format($member->price, 0, ',', '.') }}</li>
                            @endforeach 
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
