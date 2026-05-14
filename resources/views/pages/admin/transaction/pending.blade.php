@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pending Transaction</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> 
            Generate Report
        </a>
    </div>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="font-weight-bold text-primary m-0 float-left">Pending Transaction</h4>
        </div>
        <div class="card-body">
            <!-- Alert Success -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif 

            <!-- Alert Error -->
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <strong>{{ session('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif 

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th width="50">No</th>
                            <th>Name</th>
                            <th>Wallet Name</th>
                            <th>Account Number</th>
                            <th>Requested Member</th>
                            <th>Price</th>
                            <th>Transaction Date</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $index => $transaction)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td class="text-left">
                                    <strong>{{ $transaction->user->name ?? 'N/A' }}</strong>
                                    <br>
                                    <small class="text-muted">@ {{ $transaction->user->username ?? 'N/A' }}</small>
                                </td>
                                <td>
                                    {{ $transaction->payment->name ?? 'N/A' }}
                                </td>
                                <td>{{ $transaction->account_number ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $transaction->member->name ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    Rp {{ number_format($transaction->member->price ?? 0,0, ',', '.' ) }}
                                </td>
                                <td>
                                    {{ $transaction->created_at ? $transaction->created_at->format('d M Y H:i') : 'N/A' }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <!-- View Button -->
                                        <button type="button" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#viewModal{{ $transaction->id }}">
                                            <i class="fas fa-eye fa-sm text-white-100"></i>
                                        </button>

                                        <!-- Approve Button -->
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveModal">
                                            <i class="fas fa-check"></i>
                                        </button>

                                        <!-- Reject Button -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectModal">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        
                                    </div>
                                </td>
                            </tr>
                        @empty 
                            <tr>
                                <td colspan="8" class="text-center">
                                    <div class="py-5">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No pending transactions found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($transactions as $transaction)
<!-- Detail Modal -->
<div class="modal fade" id="viewModal{{ $transaction->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $transaction->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel{{ $transaction->id }}">View Detail of : <b>{{ $transaction->user->username }}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext" id="title">
                            {{ $transaction->user->name }}
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">
                            {{ $transaction->user->email }}
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="source" class="col-sm-4 col-form-label">Wallet Name</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">
                            {{ $transaction->payment->name }}
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Transaction Date</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">
                            {{ $transaction->created_at }}
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="thumbnail" class="col-sm-4 col-form-label">Payment Proof</label>
                    <div class="col-sm-8">
                        <img src="{{ asset('storage/'.$transaction->payment_proof) }}" class="img-thumbnail" alt="{{ $transaction->user->username }}" width="200" id="thumbnail" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Account Number</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">
                            {{ $transaction->account_number }}
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Requested Member</label>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">
                            {{ $transaction->member->name }}
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4 col-form-label font-weight-bold">Status</div>
                    <div class="col-sm-8">
                        <p class="form-control-plaintext">
                            {{ $transaction->status }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">
                    <b class="text-danger">Canceled Transaction</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <b>Tell to the user why this transaction is canceled</b>
                </p>
                <div class="mb-3">
                    <label for="message" class="col-form-label">
                        <b>User</b>
                    </label>
                    <p>N / A</p>
                </div> 
                <div class="mb-3">
                    <label for="message" class="col-form-label">
                        <b>Message</b>
                    </label>
                    <textarea id="message" class="form-control"></textarea>
                    <div class="invalid-feedback">
                        #
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">
                    <b class="text-success">Approve Transaction</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <b>Tell to the user why this transaction is canceled</b>
                </p>
                <div class="mb-3">
                    <label for="message" class="col-form-label">
                        <b>User</b>
                    </label>
                    <p>N / A</p>
                </div> 
                <div class="mb-3">
                    <label for="message" class="col-form-label">
                        <b>Message</b>
                    </label>
                    <textarea id="message" class="form-control" disabled>You are member now</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Approve</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- /.container-fluid -->
@endsection 