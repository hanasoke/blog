<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Rejected Transactions Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        
        .container {
            padding: 20px;
        }
        
        /* Header Styles */
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #e74a3b;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #e74a3b;
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .header .subtitle {
            color: #666;
            font-size: 14px;
        }
        
        /* Report Info */
        .report-info {
            background: #f8f9fc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #e3e6f0;
        }
        
        .report-info table {
            width: 100%;
        }
        
        .report-info td {
            padding: 5px;
        }
        
        .report-info td.label {
            font-weight: bold;
            width: 180px;
        }
        
        /* Summary Cards */
        .summary {
            display: flex;
            margin-bottom: 25px;
            gap: 15px;
        }
        
        .summary-card {
            flex: 1;
            background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            color: white;
        }
        
        .summary-card:nth-child(2) {
            background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
        }
        
        .summary-card:nth-child(3) {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        
        .summary-card h3 {
            font-size: 28px;
            margin-bottom: 5px;
        }
        
        .summary-card p {
            font-size: 12px;
            opacity: 0.9;
        }
        
        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 10px;
        }
        
        .data-table th {
            background-color: #e74a3b;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }
        
        .data-table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        
        .data-table tr:nth-child(even) {
            background-color: #f8f9fc;
        }
        
        /* Stats Sections */
        .stats-section {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fc;
            border-radius: 10px;
            border: 1px solid #e74a3b;
        }
        
        .stats-section h3 {
            color: #e74a3b;
            margin-bottom: 15px;
            font-size: 16px;
        }
        
        .stat-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px;
            background: white;
            border-radius: 5px;
            border: 1px solid #e3e6f0;
        }
        
        .stat-label {
            font-weight: bold;
            font-size: 11px;
        }
        
        .stat-value {
            color: #e74a3b;
            font-weight: bold;
            font-size: 12px;
        }
        
        .progress-bar-container {
            background-color: #e3e6f0;
            border-radius: 10px;
            height: 8px;
            width: 200px;
            overflow: hidden;
        }
        
        .progress-bar {
            background-color: #e74a3b;
            height: 100%;
            border-radius: 10px;
        }
        
        /* Two column layout */
        .two-columns {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }
        
        .column {
            flex: 1;
        }
        
        /* Badge */
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }
        
        .badge-danger {
            background-color: #e74a3b;
            color: white;
        }
        
        .badge-warning {
            background-color: #f6c23e;
            color: #333;
        }
        
        .message-box {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 10px;
            margin: 5px 0;
            font-size: 9px;
        }
        
        /* Footer */
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #e3e6f0;
            padding-top: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        
        /* Text alignment */
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-left {
            text-align: left;
        }
        
        /* Message styling */
        .rejection-message {
            font-style: italic;
            color: #856404;
            background-color: #fff3cd;
            padding: 5px;
            border-radius: 3px;
            font-size: 9px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Rejected Transactions Report</h1>
            <p class="subtitle">Blog Management System - Rejected Membership Upgrade Report</p>
        </div>
        
        <!-- Report Information -->
        <div class="report-info">
            <table>
                <tr>
                    <td class="label">Generated Date:</td>
                    <td><strong>{{ $generated_date }}</strong></td>
                    <td class="label">Generated By:</td>
                    <td><strong>{{ $generated_by }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Report Type:</td>
                    <td><strong>{{ ucfirst($report_type) }} Report</strong></td>
                    <td class="label">Orientation:</td>
                    <td><strong>{{ ucfirst($orientation) }}</strong></td>
                </tr>
                @if($start_date && $end_date)
                <tr>
                    <td class="label">Date Range:</td>
                    <td colspan="3"><strong>{{ date('d F Y', strtotime($start_date)) }} - {{ date('d F Y', strtotime($end_date)) }}</strong></td>
                </tr>
                @endif
            </table>
        </div>
        
        <!-- Summary Cards -->
        <div class="summary">
            <div class="summary-card">
                <h3>{{ number_format($totalTransactions, 0, ',', '.') }}</h3>
                <p>Total Rejected Transactions</p>
            </div>
            <div class="summary-card">
                <h3>{{ number_format($uniqueUsers, 0, ',', '.') }}</h3>
                <p>Unique Users</p>
            </div>
            <div class="summary-card">
                <h3>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                <p>Total Revenue Lost</p>
            </div>
        </div>
        
        <!-- Transactions Data Table -->
        <table class="data-table">
            <thead>
                <tr>
                    <th width="30" class="text-center">No</th>
                    <th>User</th>
                    <th>Requested Package</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th width="100">Request Date</th>
                    <th width="100">Rejected Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $index => $transaction)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $transaction->user->name ?? 'N/A' }}</strong><br>
                        <small>{{ $transaction->user->username ?? 'N/A' }}</small><br>
                        <small class="text-muted">{{ $transaction->user->email ?? 'N/A' }}</small>
                    </td>
                    <td><span class="badge badge-warning">{{ $transaction->member->name ?? 'N/A' }}</span></td>
                    <td>{{ $transaction->payment->name ?? 'N/A' }}</td>
                    <td class="text-center">Rp {{ number_format($transaction->member->price ?? 0, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $transaction->created_at ? date('d M Y', strtotime($transaction->created_at)) : 'N/A' }}</td>
                    <td class="text-center">{{ $transaction->updated_at ? date('d M Y', strtotime($transaction->updated_at)) : 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No rejected transactions found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <!-- Two Columns for Statistics -->
        <div class="two-columns">
            <!-- Left Column -->
            <div class="column">
                <!-- Package Distribution -->
                @if(count($packageStats) > 0)
                <div class="stats-section" style="margin-bottom: 20px;">
                    <h3>Rejected by Package</h3>
                    @foreach($packageStats as $packageName => $stats)
                    @php
                        $percentage = $totalTransactions > 0 ? round(($stats['count'] / $totalTransactions) * 100, 1) : 0;
                    @endphp
                    <div class="stat-item">
                        <span class="stat-label">{{ $packageName }}</span>
                        <div style="flex: 1; margin: 0 15px;">
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: {{ $percentage }}%;"></div>
                            </div>
                        </div>
                        <span class="stat-value">{{ $stats['count'] }} ({{ $percentage }}%)</span>
                    </div>
                    @endforeach
                </div>
                @endif
                
                <!-- Monthly Rejection Trends -->
                @if(count($monthlyStats) > 0)
                <div class="stats-section" style="margin-top: 0;">
                    <h3>Monthly Rejection Trends</h3>
                    @foreach($monthlyStats as $month => $count)
                    @php
                        $maxCount = collect($monthlyStats)->max();
                        $percentage = $maxCount > 0 ? round(($count / $maxCount) * 100, 1) : 0;
                    @endphp
                    <div class="stat-item">
                        <span class="stat-label">{{ $month }}</span>
                        <div style="flex: 1; margin: 0 15px;">
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: {{ $percentage }}%;"></div>
                            </div>
                        </div>
                        <span class="stat-value">{{ $count }} rejected</span>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            
            <!-- Right Column -->
            <div class="column">
                <!-- Payment Method Distribution -->
                @if(count($paymentStats) > 0)
                <div class="stats-section" style="margin-bottom: 20px;">
                    <h3>Rejected by Payment Method</h3>
                    @foreach($paymentStats as $paymentName => $count)
                    @php
                        $percentage = $totalTransactions > 0 ? round(($count / $totalTransactions) * 100, 1) : 0;
                    @endphp
                    <div class="stat-item">
                        <span class="stat-label">{{ $paymentName }}</span>
                        <div style="flex: 1; margin: 0 15px;">
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: {{ $percentage }}%;"></div>
                            </div>
                        </div>
                        <span class="stat-value">{{ $count }} ({{ $percentage }}%)</span>
                    </div>
                    @endforeach
                </div>
                @endif
                
                <!-- Revenue Lost by Package -->
                @if(count($packageStats) > 0)
                <div class="stats-section" style="margin-top: 0;">
                    <h3>Revenue Lost by Package</h3>
                    @foreach($packageStats as $packageName => $stats)
                    @php
                        $percentage = $totalRevenue > 0 ? round(($stats['revenue'] / $totalRevenue) * 100, 1) : 0;
                    @endphp
                    <div class="stat-item">
                        <span class="stat-label">{{ $packageName }}</span>
                        <div style="flex: 1; margin: 0 15px;">
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: {{ $percentage }}%;"></div>
                            </div>
                        </div>
                        <span class="stat-value">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        
        <!-- Rejection Messages Section -->
        @if($transactions->where('admin_message')->count() > 0)
        <div class="stats-section" style="margin-top: 20px;">
            <h3>Recent Rejection Messages</h3>
            @foreach($transactions->take(5) as $transaction)
                @if($transaction->admin_message)
                <div class="stat-item" style="flex-direction: column; align-items: flex-start;">
                    <div style="width: 100%; margin-bottom: 5px;">
                        <strong>{{ $transaction->user->name }}</strong> 
                        <span class="badge badge-warning" style="float: right;">{{ $transaction->member->name }}</span>
                    </div>
                    <div class="rejection-message" style="width: 100%;">
                        "{{ Str::limit($transaction->admin_message->message, 150) }}"
                    </div>
                    <small class="text-muted" style="margin-top: 5px;">Rejected: {{ $transaction->updated_at->format('d M Y H:i') }}</small>
                </div>
                @endif
            @endforeach
        </div>
        @endif
        
        <!-- Summary Info -->
        <div class="stats-section" style="margin-top: 20px;">
            <h3>Rejection Summary</h3>
            <div class="stat-item">
                <span class="stat-label">Most Recent Rejection:</span>
                <span class="stat-value">{{ $newestTransaction ? $newestTransaction->user->name . ' - ' . $newestTransaction->member->name . ' (' . date('d M Y', strtotime($newestTransaction->updated_at)) . ')' : 'N/A' }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">First Rejection:</span>
                <span class="stat-value">{{ $oldestTransaction ? $oldestTransaction->user->name . ' - ' . $oldestTransaction->member->name . ' (' . date('d M Y', strtotime($oldestTransaction->updated_at)) . ')' : 'N/A' }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Average Rejection Value:</span>
                <span class="stat-value">Rp {{ $totalTransactions > 0 ? number_format($totalRevenue / $totalTransactions, 0, ',', '.') : '0' }}</span>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>This report is system-generated at {{ $generated_date }}. For inquiries, please contact system administrator.</p>
            <p>&copy; {{ date('Y') }} Blog Management System. All rights reserved.</p>
            <p>Page {PAGE_NUM} of {PAGE_COUNT}</p>
        </div>
    </div>
</body>
</html>