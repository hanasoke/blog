@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Blog</h1>
        <a href="{{ route('blogs_data') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Blogs 
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Edit Blog</h6>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="title">Blog Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Edit Blog Title" value="{{ old('title', $blog->title) }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror 
                </div>
                <div class="form-group">
                    <label for="genre_id">Genre <span class="text-danger">*</span></label>
                    <select class="form-control @error('genre_id') is-invalid @enderror" id="genre_id" name="genre_id">
                        <option value="">Choose Genre</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ old('genre_id', $blog->genre_id) == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('genre_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror 
                </div>
                <div class="form-group">
                    <label for="source_id">Source <span class="text-danger">*</span></label>
                    <select class="form-control @error('source_id') is-invalid @enderror" id="source_id" name="source_id">
                        <option value="#">Choose Source</option>
                        @foreach($sources as $source) 
                            <option value="{{ $source->id }}" {{ old('source_id', $blog->source_id) == $source->id ? 'selected' : '' }}>
                                {{ $source->name }}
                            </option>
                        @endforeach 
                    </select>
                    @error('source_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror 
                </div>

                <!-- Current Thumbnail Preview -->
                 <div class="form-group">
                    <label>Current Tumbnail</label>
                    <div>
                        <img src="{{ asset('storage/'.$blog->thumbnail) }}" alt="{{ $blog->title }}" class="img-thumbnail" width="200">
                    </div>
                 </div>

                <div class="form-group">
                    <label for="thumbnail">Change Thumbnail (Optional)</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input is-invalid" id="thumbnail">
                        <label class="custom-file-label" for="thumbnail">Choose file...</label>
                        <div class="invalid-feedback">
                            #
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image_2">Image 2 (Optional)</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input is-invalid" id="image_2">
                        <label class="custom-file-label" for="image_2">Choose file...</label>
                        <div class="invalid-feedback">
                            #
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image_3">Image 3 (Optional)</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input is-invalid" id="image_3">
                        <label class="custom-file-label" for="image_3">Choose file...</label>
                        <div class="invalid-feedback">
                            #
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control is-invalid" id="description" rows="3"></textarea>
                    <div class="invalid-feedback">
                        #
                    </div>
                </div>
                <button class="btn btn-success btn-lg btn-block">Submit</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 