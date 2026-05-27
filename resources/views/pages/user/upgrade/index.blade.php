@extends('layouts.user.template')

@section('content')
  <!-- Notification Section for User -->
  @if($unreadMessages->count() > 0)
    <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-envelope me-2"></i>
        <strong>You have {{ $unreadMessages->count() }} new message(s) from admin!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <!-- Admin Messages Section -->
  @if($allMessages->count() > 0)
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-chat-dots me-2"></i> Messages from Admin</h5>
        </div>
        <div class="card-body">
            @foreach($allMessages as $message)
                <div class="alert alert-{{ $message->transaction->status == 'APPROVED' ? 'success' : 'danger' }} mb-3 {{ !$message->is_read ? 'border-start border-4 border-primary' : '' }}">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <strong>
                                @if($message->transaction->status == 'APPROVED')
                                    <i class="bi bi-check-circle-fill text-success me-1"></i> Transaction Approved
                                @else
                                    <i class="bi bi-x-circle-fill text-danger me-1"></i> Transaction Rejected
                                @endif
                            </strong>
                            <span class="badge bg-{{ $message->transaction->status == 'APPROVED' ? 'success' : 'danger' }} ms-2">
                                {{ $message->transaction->member->name ?? 'N/A' }}
                            </span>
                            @if(!$message->is_read)
                                <span class="badge bg-primary ms-2">New</span>
                            @endif
                        </div>
                        <small class="text-muted">{{ $message->created_at->format('d M Y H:i') }}</small>
                    </div>
                    <hr>
                    <p>{{ $message->message }}</p>
                    @if(!$message->is_read)
                        <button class="btn btn-sm btn-outline-primary mark-read-btn" data-id="{{ $message->id }}">
                            <i class="bi bi-check2-circle me-1"></i> Mark as Read
                        </button>
                    @endif
                </div>
            @endforeach
            @if($unreadMessages->count() > 0)
                <button class="btn btn-sm btn-secondary mt-2" id="markAllReadBtn">
                    <i class="bi bi-check2-all me-1"></i> Mark All as Read
                </button>
            @endif
        </div>
    </div>
  @endif

  <!-- HERO -->
  <section class="hero">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-7">
          <h1 class="text-uppercase fw-semibold">Membership</span>
        </div>
      </div>
    </div>
  </section>

  <!-- BLOG LIST -->
  <section class="py-5">
    <div class="container">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle-fill me-2"></i>
          <strong>Success!</strong> {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          <strong>Error!</strong> {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif 

      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title my-2">
                <i class="bi bi-person-badge me-2"></i> Membership Status
              </h5>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <div class="my-2 row">
                  <label class="col-sm-2">Name</label>
                  <div class="col-sm-10">
                    <h6>
                      {{ $user->name }}
                    </h6>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="my-2 row">
                  <label class="col-sm-2">Username</label>
                  <div class="col-sm-10">
                    <h6>{{ $user->username }}</h6>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="my-2 row">
                  <label class="col-sm-2">Email</label>
                  <div class="col-sm-10">
                    <h6>{{ $user->email }}</h6>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="my-2 row">
                  <label class="col-sm-2">Current Access</label>
                  <div class="col-sm-10">
                    @php 
                      $badgeClass = 'secondary';
                      switch($user->access) {
                        case 'FREE': $badgeClass = 'secondary'; break;
                        case 'BASIC': $badgeClass = 'success'; break;
                        case 'PREMIUM': $badgeClass = 'warning'; break;
                        case 'VIP': $badgeClass = 'primary'; break;
                      }
                    @endphp 
                    <span class="badge text-bg-{{ $badgeClass }}">
                      {{ $user->access }}
                    </span>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                @if($pendingTransaction && $pendingTransaction->status == 'PENDING')
                  <div class="alert alert-warning mt-3">
                    <i class="bi bi-clock-history me-2"></i>
                    <strong>Pending Request!</strong> You have a pending upgrade request to 
                    <strong>{{ $pendingTransaction->member->name ?? 'N/A' }}</strong>.
                    Please wait for admin approval.
                  </div>
                @endif
                <a href="{{ route('edit_membership') }}" class="btn btn-success float-end">Upgrade Membership</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('addon-script')
  <script>
    $(document).ready(function() {
        // Mark single message as read
        $('.mark-read-btn').on('click', function() {
            var messageId = $(this).data('id');
            var btn = $(this);
            
            $.ajax({
                url: '{{ route("user.mark_message_read", "") }}/' + messageId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    btn.closest('.alert').removeClass('border-start border-4 border-primary');
                    btn.closest('.alert').find('.badge.bg-primary').remove();
                    btn.remove();
                    location.reload();
                }
            });
        });
        
        // Mark all messages as read
        $('#markAllReadBtn').on('click', function() {
            $.ajax({
                url: '{{ route("user.mark_all_messages_read") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    location.reload();
                }
            });
        });
    });
  </script>
@endpush