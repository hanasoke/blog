@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Genre</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Add Genre</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('store_genre') }}" method="POST">
                @csrf 
                <div class="form-group">
                    <label for="blog_title">Genre Name</label>
                    <input 
                        type="text"
                        name="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        value="{{ old('name') }}" 
                        id="blog_title">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror 
                </div>
                <button class="btn btn-success btn-lg btn-block">Submit</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 