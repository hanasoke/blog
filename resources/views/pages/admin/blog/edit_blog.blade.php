@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Blog</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Edit Blog</h6>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="blog_title">Blog Title</label>
                    <input type="text" class="form-control is-invalid" id="blog_title" placeholder="Edit Blog Title">
                    <div class="invalid-feedback">
                        #
                    </div>
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <select class="form-control is-invalid" id="genre">
                        <option value="#">Choose Genre</option>
                        <option>Romance</option>
                        <option>Politic</option>
                        <option>Geograpy</option>
                        <option>Paleontologi</option>
                        <option>Economic</option>
                        <option>Sports</option>
                        <option>Education</option>
                    </select>
                    <div class="invalid-feedback">
                        #
                    </div>
                </div>
                <div class="form-group">
                    <label for="source">Source</label>
                    <select class="form-control is-invalid" id="source">
                        <option value="#">Choose A Source</option>
                        <option>CNN</option>
                        <option>Kompas</option>
                        <option>New York Times</option>
                        <option>Guardian</option>
                        <option>CNBC</option>
                        <option>Detik</option>
                        <option>Trans 7</option>
                    </select>
                    <div class="invalid-feedback">
                        #
                    </div>
                </div>

                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
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