@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">Add Edit Source</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="font-weight-bold text-primary m-0 float-left">Edit Source</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('update_source', $source->id) }}" method="POST">
                @csrf 
                <div class="form-group">
                    <label for="source_name">Source Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="source_name" value="{{ old('name', $source->name) }}">
                    
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror 
                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block">Update</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection 