@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Blog</h1>
        <a href="{{ route('access_blogs') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Access 
        </a>
    </div>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Add Blog</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('store_access') }}" method="POST" enctype="multipart/form-data">
                @csrf 
                <div class="form-group">
                    <label for="blog_id">Blog Title <span class="text-danger">*</span></label>
                    <select class="form-control @error('blog_id') is-invalid @enderror" id="blog_id" name="blog_id">
                        <option value="">Choose Blog</option>
                        @foreach($blogs as $blog)
                            <option value="{{ $blog->id }}" {{ old('blog_id') == $blog->id ? 'selected' : '' }}>
                                {{ $blog->title }}
                                @if($blog->access)
                                    (Already has access: {{ $blog->access->access }})
                                @endif 
                            </option>
                        @endforeach  
                    </select>
                    @error('blog_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror 
                    <small class="text-muted">Only blogs without access level will be shown.</small>
                </div>
                
                <div class="form-group">
                    <label for="access">Blog Access <span class="text-danger">*</span></label>
                    <select class="form-control @error('access') is-invalid @enderror" id="access" name="access">
                        <option value="#">Choose Blog Access</option>
                        <option value="BASIC" {{ old('access') == 'BASIC' ? 'selected' : '' }} data-price="10000">BASIC - Rp 10.000</option>
                        <option value="PREMIUM" {{ old('access') == 'PREMIUM' ? 'selected' : '' }}  data-price="15000">PREMIUM - Rp 15.000</option>
                        <option value="VIP" {{ old('access') == 'VIP' ? 'selected' : '' }} data-price="20000">VIP - 20.000</option>
                    </select>
                    @error('access')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror 
                </div>

                <!-- Field Price (Hidden or Disabled) -->
                <div class="form-group">
                    <label for="price">Price <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" placeholder="Price will be filled automatically based on access level" readonly>
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror 
                    <small class="text-muted">Price is automatically set based on access level.</small>
                </div>

                <button type="submit" class="btn btn-success btn-lg btn-block">
                    <i class="fas fa-save"></i> Submit 
                </button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 