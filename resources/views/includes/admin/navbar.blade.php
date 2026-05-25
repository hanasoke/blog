<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Nav Item - Alerts (Notification for Pending Transactions) -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter" id="notificationBadge">0</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown" id="notificationDropdown" style="width: 350px;" >
                <h6 class="dropdown-header">
                    Notification Center
                </h6>
                <div id="notificationList">
                    <div class="text-center py-3">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted small">Loading notifications...</p>
                    </div>
                </div>
                <a class="dropdown-item text-center small text-gray-500" href="#" id="markAllReadBtn">
                    Mark all as read
                </a>
            </div>
        </li>

        <!-- Nav Item - Messages (Pending Transactions Count) -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-danger badge-counter" id="pendingTransactionBadge">0</span>
            </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown" style="width: 350px;">
                <h6 class="dropdown-header">
                    Pending Transactions
                </h6>
                <div id="pendingTransactionList">
                    <div class="text-center py-3">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted small">Loading pending transactions...</p>
                    </div>
                </div>
                <a class="dropdown-item text-center small text-gray-500" href="{{ route('pending_transaction') }}">
                    View all pending transactions
                </a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        @auth 
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                        {{ Auth::user()->name }}
                    </span>
                    <img class="img-profile rounded-circle"
                        src="{{ Auth::user()->photo 
                            ? asset('storage/' . Auth::user()->photo)
                            : asset('img/undraw_profile.svg')
                        }}">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('admin_profile') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('edit_profile') }}">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </button>
                </div>
            </li>
            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf 
                                <button type="submit" class="btn btn-primary">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endauth 
    </ul>

</nav>
<!-- End of Topbar -->

@push('addon-script')
<script>
    $(document).ready(function() {
        // Function to load pending transactions
        function loadPendingTransactions() {
            $.ajax({
                url: '{{ route("get_pending_transactions") }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var pendingCount = response.count;
                    var transactions = response.transactions;
                    
                    // Update badge
                    $('#pendingTransactionBadge').text(pendingCount);
                    
                    // Update dropdown list
                    var html = '';
                    if (transactions.length > 0) {
                        transactions.forEach(function(transaction) {
                            var date = new Date(transaction.created_at);
                            var formattedDate = date.toLocaleDateString('id-ID', {
                                day: 'numeric',
                                month: 'short',
                                hour: '2-digit',
                                minute: '2-digit'
                            });
                            
                            html += `
                                <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/pending_transaction') }}">
                                    <div class="dropdown-list-image mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-clock text-white"></i>
                                        </div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">${transaction.user.name} requested ${transaction.member.name} membership</div>
                                        <div class="small text-gray-500">${formattedDate}</div>
                                    </div>
                                </a>
                            `;
                        });
                    } else {
                        html = '<div class="text-center py-3"><p class="text-muted small mb-0">No pending transactions</p></div>';
                    }
                    $('#pendingTransactionList').html(html);
                }
            });
        }
        
        // Function to load unread notifications
        function loadNotifications() {
            $.ajax({
                url: '{{ route("get_unread_messages") }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var messages = response.messages;
                    var count = messages.length;
                    
                    // Update badge
                    $('#notificationBadge').text(count);
                    
                    // Update dropdown list
                    var html = '';
                    if (messages.length > 0) {
                        messages.forEach(function(message) {
                            var date = new Date(message.created_at);
                            var formattedDate = date.toLocaleDateString('id-ID', {
                                day: 'numeric',
                                month: 'short',
                                hour: '2-digit',
                                minute: '2-digit'
                            });
                            
                            var statusClass = message.transaction.status === 'APPROVED' ? 'success' : 'danger';
                            var statusIcon = message.transaction.status === 'APPROVED' ? 'check-circle' : 'times-circle';
                            var statusText = message.transaction.status === 'APPROVED' ? 'Approved' : 'Rejected';
                            
                            html += `
                                <a class="dropdown-item d-flex align-items-center notification-item" href="#" data-id="${message.id}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-${statusClass}">
                                            <i class="fas fa-${statusIcon} text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">${formattedDate}</div>
                                        <span class="font-weight-bold">Transaction ${statusText}</span>
                                        <div class="small text-truncate">${message.message.substring(0, 80)}...</div>
                                        <small class="text-muted">User: ${message.user.name}</small>
                                    </div>
                                </a>
                            `;
                        });
                    } else {
                        html = '<div class="text-center py-3"><p class="text-muted small mb-0">No new notifications</p></div>';
                    }
                    $('#notificationList').html(html);
                    
                    // Mark as read when clicked
                    $('.notification-item').on('click', function(e) {
                        e.preventDefault();
                        var messageId = $(this).data('id');
                        $.ajax({
                            url: '{{ url("admin/mark_message_read") }}/' + messageId,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                loadNotifications();
                            }
                        });
                    });
                }
            });
        }
        
        // Mark all as read
        $('#markAllReadBtn').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("mark_all_messages_read") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    loadNotifications();
                }
            });
        });
        
        // Load data on page load
        loadPendingTransactions();
        loadNotifications();
        
        // Refresh every 30 seconds
        setInterval(function() {
            loadPendingTransactions();
            loadNotifications();
        }, 30000);
    });
</script>
@endpush
