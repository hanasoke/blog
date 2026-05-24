<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Success Transactions Report</title>
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
            border-bottom: 2px solid #1cc88a;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #1cc88a;
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
            background: #f8f9fc;
            border: 1px solid #e3e6f0;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
        }
        
        .summary-card h3 {
            font-size: 28px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .summary-card p {
            font-size: 12px;
            color: #4e73df;
        }
        
        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 10px;
        }
        
        .data-table th {
            background-color: #1cc88a;
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
            border: 1px solid #1cc88a;
        }
        
        .stats-section h3 {
            color: #1cc88a;
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
            color: #1cc88a;
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
            background-color: #1cc88a;
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
        
        .badge-success {
            background-color: #1cc88a;
            color: white;
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
        
        /* Currency */
        .currency {
            font-weight: bold;
            color: #1cc88a;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Success Transactions Report</h1>
            <p class="subtitle">Blog Management System - Approved Transactions Report</p>
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
                <p>Total Transactions</p>
            </div>
            <div class="summary-card">
                <h3>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                <p>Total Revenue</p>
            </div>
            <div class="summary-card">
                <h3>{{ number_format($uniqueUsers, 0, ',', '.') }}</h3>
                <p>Unique Users</p>
            </div>
        </div>
        
        <!-- Transactions Data Table -->
        <table class="data-table">
            <thead>
                <tr>
                    <th width="30" class="text-center">No</th>
                    <th>User</th>
                    <th>Package</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th width="100">Approved Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $index => $transaction)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $transaction->user->name ?? 'N/A' }}</strong><br>
                        <small>{{ $transaction->user->username ?? 'N/A' }}</small>
                    </td>
                    <td><span class="badge badge-success">{{ $transaction->member->name ?? 'N/A' }}</span></td>
                    <td>{{ $transaction->payment->name ?? 'N/A' }}</td>
                    <td class="currency">Rp {{ number_format($transaction->member->price ?? 0, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $transaction->updated_at ? date('d M Y', strtotime($transaction->updated_at)) : 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No approved transactions found.</td>
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
                    <h3>Package Distribution</h3>
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
            </div>
            
            <!-- Right Column -->
            <div class="column">
                <!-- Revenue by Package -->
                @if(count($packageStats) > 0)
                <div class="stats-section" style="margin-bottom: 20px;">
                    <h3>Revenue by Package</h3>
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
        
        <!-- Monthly Statistics -->
        @if(count($monthlyStats) > 0)
        <div class="stats-section" style="margin-top: 0;">
            <h3>Monthly Transaction Trends</h3>
            @foreach($monthlyStats as $month => $data)
            <div class="stat-item">
                <span class="stat-label">{{ $month }}</span>
                <div style="flex: 1; margin: 0 15px;">
                    <div class="progress-bar-container">
                        @php
                            $maxCount = collect($monthlyStats)->max('count');
                            $percentage = $maxCount > 0 ? round(($data['count'] / $maxCount) * 100, 1) : 0;
                        @endphp
                        <div class="progress-bar" style="width: {{ $percentage }}%;"></div>
                    </div>
                </div>
                <span class="stat-value">{{ $data['count'] }} transactions (Rp {{ number_format($data['revenue'], 0, ',', '.') }})</span>
            </div>
            @endforeach
        </div>
        @endif
        
        <!-- Summary Info -->
        <div class="stats-section" style="margin-top: 20px;">
            <h3>Transaction Summary</h3>
            <div class="stat-item">
                <span class="stat-label">Newest Transaction:</span>
                <span class="stat-value">{{ $newestTransaction ? $newestTransaction->user->name . ' - ' . date('d M Y', strtotime($newestTransaction->updated_at)) : 'N/A' }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Oldest Transaction:</span>
                <span class="stat-value">{{ $oldestTransaction ? $oldestTransaction->user->name . ' - ' . date('d M Y', strtotime($oldestTransaction->updated_at)) : 'N/A' }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Average Transaction Value:</span>
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