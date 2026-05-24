@extends('layouts.admin.template')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pending Transaction</h1>
        <div>
            <!-- Generate Report Button -->
            <button type="button" class="btn btn-sm btn-warning shadow-sm" data-toggle="modal" data-target="#reportModal">
                <i class="fas fa-download fa-sm text-white-50"></i> 
                Generate Report
            </button>
            
            <!-- Export CSV Button -->
            <a href="{{ route('export_pending_csv') }}" class="btn btn-sm btn-success shadow-sm ml-2">
                <i class="fas fa-file-excel fa-sm text-white-50"></i> 
                Export CSV
            </a>
        </div>
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
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveModal{{ $transaction->id }}">
                                            <i class="fas fa-check"></i>
                                        </button>

                                        <!-- Reject Button -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectModal{{ $transaction->id }}">
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

<!-- Report Generation Modal for Pending -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="reportModalLabel">
                    <i class="fas fa-download"></i> Generate Pending Transactions Report
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('generate_pending_report') }}" method="GET" target="_blank">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Report Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="report_type" id="report_type" required>
                            <option value="all">All Pending Transactions</option>
                            <option value="date_range">By Date Range</option>
                        </select>
                    </div>
                    
                    <div class="form-group" id="date_range_fields" style="display: none;">
                        <label>Start Date <span class="text-danger">*</span></label>
                        <input type="date" name="start_date" class="form-control">
                        <br>
                        <label>End Date <span class="text-danger">*</span></label>
                        <input type="date" name="end_date" class="form-control">
                        <small class="text-muted">Filter by request date</small>
                    </div>
                    
                    <div class="form-group">
                        <label>Page Orientation <span class="text-danger">*</span></label>
                        <select class="form-control" name="orientation" required>
                            <option value="portrait">Portrait</option>
                            <option value="landscape" selected>Landscape (Recommended)</option>
                        </select>
                    </div>
                    
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle"></i>
                        <strong>Info:</strong> The report will include all pending transactions waiting for admin approval.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-download"></i> Generate PDF
                    </button>
                </div>
            </form>
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

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal{{ $transaction->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $transaction->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white"">
                <h5 class="modal-title" id="rejectModalLabel{{ $transaction->id }}">
                    Reject Transaction
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                </button>
            </div>
            <form action="{{ route('reject_transaction', $transaction->id) }}" method="POST">
                @csrf 
                @method('PUT')
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i>
                        <strong>Transaction Details</strong><br>
                        User: <strong>{{ $transaction->user->name }}</strong><br>
                        Requested Member: <strong>{{ $transaction->member->name }}</strong>
                    </div>
                    
                    <div class="form-group">
                        <label for="reject_message_{{ $transaction->id }}">Rejection Message <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="reject_message_{{ $transaction->id }}" name="message" rows="4" required placeholder="Please provide a reason why this transaction is rejected...">Dear {{ $transaction->user->name }}, We regret to inform you that your membership upgrade request to {{ $transaction->member->name }} has been rejected because 
                        </textarea>
                        <small class="text-danger">You must provide a reason for rejection.</small>
                    </div>
                    
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Warning:</strong> This action cannot be undone.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times"></i> Yes, Reject
                    </button>
                </div>
            
            </form>
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approveModal{{ $transaction->id }}" tabindex="-1" aria-labelledby="approveModalLabel{{ $transaction->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel{{ $transaction->id }}">
                    <b class="text-success">Approve Transaction</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                </button>
            </div>
            <form action="{{ route('approve_transaction', $transaction->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Transaction Details:</strong><br>
                        User: <strong>{{ $transaction->user->name }}</strong><br>
                        Requested Member: <strong>{{ $transaction->member->name }}</strong><br>
                        Current Access: <strong>{{ $transaction->user->access }}</strong>
                    </div>
                    
                    <div class="form-group">
                        <label for="approve_message_{{ $transaction->id }}">Success Message (Optional)</label>
                        <textarea class="form-control" id="approve_message_{{ $transaction->id }}" name="message" rows="4" placeholder="Write a custom success message or leave empty for default template...">Congratulations! Your membership upgrade request to {{ $transaction->member->name }} has been approved. Your account has been upgraded from {{ $transaction->user->access }} to {{ $transaction->member->name }}. Thank you for trusting us!</textarea>
                        <small class="text-muted">Leave empty to use default success message.</small>
                    </div>
                    
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Warning:</strong> Approving this transaction will automatically upgrade the user's membership level.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Yes, Approve
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- /.container-fluid -->
@endsection 
