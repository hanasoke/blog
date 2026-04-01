@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Blog</h1>
        <a href="{{ route('blogs_data') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Blogs 
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Add Blog</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('store_blog') }}" method="POST" enctype="multipart/form-data">
                @csrf 
                <div class="form-group">
                    <label for="title">Blog Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Input Blog Title" value="{{ old('title') }}">

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
                            <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
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
                        <option value="">Choose Source</option>
                        @foreach($sources as $source)
                            <option value="{{ $source->id }}" {{ old('source_id') == $source->id ? 'selected' : '' }}>
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

                <div class="form-group">
                    <label for="thumbnail">Thumbnail <span class="text-danger">*</span></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail">
                        <label class="custom-file-label" for="thumbnail">Choose file...</label>
                        @error('thumbnail')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror 
                    </div>
                    <small class="text-muted">Max: 2MB (JPG, JPEG, PNG)</small>
                    <img id="thumbnailPreview" src="#" alt="Preview" style="display: none; max-width: 200px; margin-top: 10px;" class="img-thumbnail">
                </div>

                <div class="form-group">
                    <label for="image_2">Image 2 (Optional)</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('image_2') is-invalid @enderror" id="image_2" name="image_2">
                        <label class="custom-file-label" for="image_2">Choose file...</label>
                        @error('image_2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror 
                    </div>
                    <small class="text-muted">Max: 2MB (JPG, JPEG, PNG)</small>
                    <img id="image2Preview" src="#" alt="Preview" style="display: none; max-width: 200px; margin-top: 10px;" class="img-thumbnail">
                </div>

                <div class="form-group">
                    <label for="image_3">Image 3 (Optional)</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('image_3') is-invalid @enderror" id="image_3" name="image_3">
                        <label class="custom-file-label" for="image_3">Choose file...</label>

                        @error('image_3')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror 
                    </div>
                    <small class="text-muted">Max: 2MB (JPG, JPEG, PNG)</small>
                    <img id="image3Preview" src="#" alt="Preview" style="display: none; max-width: 200px; margin-top: 10px;" class="img-thumbnail">
                </div>

                <div class="form-group">
                    <label for="description">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
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

@push('addon-script')
<script>
    $(document).ready(function() {
        // Update file input label when file is selected
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
            
            // Preview image
            var inputId = $(this).attr('id');
            if (inputId === 'thumbnail') {
                previewImage(this, '#thumbnailPreview');
            } else if (inputId === 'image_2') {
                previewImage(this, '#image2Preview');
            } else if (inputId === 'image_3') {
                previewImage(this, '#image3Preview');
            }
        });
        
        function previewImage(input, previewElement) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(previewElement).attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $(previewElement).hide();
            }
        }
    });
</script>
@endpush