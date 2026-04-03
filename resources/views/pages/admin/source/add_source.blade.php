@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Source</h1>
        <a href="{{ route('sources_list') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Sources List
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Add Source</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('adding_source') }}" method="POST">
                @csrf 
                <div class="form-group">
                    <label for="source_name">Source Name</label>
                    <input 
                        type="text"
                        name="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        value="{{ old('name') }}" 
                        id="source_name" placeholder="Input Your Source Name">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message}}
                        </div>
                    @enderror 
                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 