<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Payments Report</title>
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
            border-bottom: 3px solid #1cc88a;
            padding-bottom: 20px;
            position: relative;
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
        
        .logo {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
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
            color: #1cc88a;
        }
        
        /* Summary Cards */
        .summary {
            display: flex;
            margin-bottom: 25px;
            gap: 15px;
        }
        
        .summary-card {
            flex: 1;
            background: linear-gradient(135deg, #1cc88a 0%, #13855e 100%);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            color: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .summary-card:nth-child(2) {
            background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);
        }
        
        .summary-card:nth-child(3) {
            background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
        }
        
        .summary-card:nth-child(4) {
            background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);
        }
        
        .summary-card h3 {
            font-size: 32px;
            margin-bottom: 8px;
            font-weight: bold;
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
            font-size: 11px;
        }
        
        .data-table th {
            background: linear-gradient(135deg, #1cc88a 0%, #13855e 100%);
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
        
        .data-table tr:hover {
            background-color: #f5f5f5;
        }
        
        /* Badge */
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }
        
        .badge-primary {
            background-color: #1cc88a;
            color: white;
        }
        
        .badge-success {
            background-color: #36b9cc;
            color: white;
        }
        
        .badge-warning {
            background-color: #f6c23e;
            color: white;
        }
        
        .badge-info {
            background-color: #858796;
            color: white;
        }
        
        /* Payment Info Section */
        .payment-stats {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fc;
            border-radius: 10px;
            border: 1px solid #e3e6f0;
        }
        
        .payment-stats h3 {
            color: #1cc88a;
            margin-bottom: 15px;
            font-size: 16px;
        }
        
        .stat-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background: white;
            border-radius: 5px;
            margin-bottom: 10px;
            border-left: 4px solid #1cc88a;
        }
        
        .stat-label {
            font-weight: bold;
            font-size: 13px;
        }
        
        .stat-value {
            color: #1cc88a;
            font-weight: bold;
            font-size: 14px;
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
        
        /* Page break */
        .page-break {
            page-break-before: always;
        }
        
        /* Bank/EWallet Icon */
        .payment-icon {
            width: 32px;
            height: 32px;
            background-color: #1cc88a;
            border-radius: 8px;
            display: inline-block;
            text-align: center;
            line-height: 32px;
            color: white;
            font-weight: bold;
            margin-right: 10px;
        }
        
        .payment-name {
            font-weight: bold;
            font-size: 13px;
        }
        
        .payment-meta {
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            @if(file_exists(public_path('img/logo.png')))
                <img src="{{ public_path('img/logo.png') }}" class="logo" alt="Logo">
            @endif
            <h1>Payment Methods Report</h1>
            <p class="subtitle">Blog Management System - Payment Gateway Analytics</p>
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
                <h3>{{ $totalPayments }}</h3>
                <p>Total Payment Methods</p>
            </div>
            <div class="summary-card">
                <h3>{{ $newThisMonth }}</h3>
                <p>New This Month</p>
            </div>
            <div class="summary-card">
                <h3>{{ $oldestPayment ? date('d M Y', strtotime($oldestPayment->created_at)) : 'N/A' }}</h3>
                <p>Oldest Payment</p>
            </div>
            <div class="summary-card">
                <h3>{{ $newestPayment ? date('d M Y', strtotime($newestPayment->created_at)) : 'N/A' }}</h3>
                <p>Newest Payment</p>
            </div>
        </div>
        
        <!-- Data Table -->
        <table class="data-table">
            <thead>
                <tr>
                    <th width="40" class="text-center">No.</th>
                    <th>Payment Method</th>
                    <th width="150" class="text-center">Status</th>
                    <th width="150">Created At</th>
                    <th width="150">Last Updated</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $index => $payment)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <div style="display: flex; align-items: center;">
                            <div class="payment-icon">
                                {{ substr($payment->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="payment-name">{{ $payment->name }}</div>
                                <div class="payment-meta">ID: #{{ $payment->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="badge badge-primary">Active</span>
                    </td>
                    <td>{{ $payment->created_at ? date('d M Y H:i', strtotime($payment->created_at)) : 'N/A' }}</td>
                    <td>{{ $payment->updated_at ? date('d M Y H:i', strtotime($payment->updated_at)) : 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No payment methods found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <!-- Payment Statistics Section -->
        @if($payments->count() > 0)
        <div class="payment-stats">
            <h3>📊 Payment Statistics</h3>
            <div class="stat-item">
                <span class="stat-label">Total Active Payment Methods</span>
                <span class="stat-value">{{ $totalPayments }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Average Payment Age</span>
                <span class="stat-value">
                    @php
                        $avgAge = 0;
                        if($totalPayments > 0) {
                            $totalDays = 0;
                            foreach($payments as $payment) {
                                if($payment->created_at) {
                                    $totalDays += $payment->created_at->diffInDays(now());
                                }
                            }
                            $avgAge = round($totalDays / $totalPayments);
                        }
                    @endphp
                    {{ $avgAge }} days
                </span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Payment Methods Added (Last 30 Days)</span>
                <span class="stat-value">
                    {{ Payment::where('created_at', '>=', now()->subDays(30))->count() }}
                </span>
            </div>
        </div>
        @endif
        
        <!-- Footer -->
        <div class="footer">
            <p>This report is system-generated at {{ $generated_date }}. For inquiries, please contact system administrator.</p>
            <p>&copy; {{ date('Y') }} Blog Management System. All rights reserved.</p>
            <p>Page {PAGE_NUM} of {PAGE_COUNT}</p>
        </div>
    </div>
</body>
</html>