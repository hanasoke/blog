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
        }
        
        .summary-card {
            flex: 1;
            background: #fff;
            border: 1px solid #e3e6f0;
            border-radius: 5px;
            padding: 15px;
            margin: 0 5px;
            color: dark;
            text-align: center;
        }
        
        .summary-card h3 {
            font-size: 32px;
            color: #00ff40ff;
            margin-bottom: 5px;
        }
        
        .summary-card p {
            color: #666;
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
            background-color: #54ec68ff;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }
        
        .data-table td {
            padding: 10px;
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
            background-color: #006effff;
            color: white;
        }
        
        .badge-success {
            background-color: #2bb40fff;
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
            text-align: center !important;
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
        
        
        .payment-name {
            font-weight: bold;
            font-size: 13px;
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
                <p>Total Wallet Name</p>
            </div>
            <div class="summary-card">
                <h3>{{ $newThisMonth }}</h3>
                <p>New This Month</p>
            </div>
            <div class="summary-card">
                <h3>{{ $oldestPayment ? date('d M Y', strtotime($oldestPayment->created_at)) : 'N/A' }}</h3>
                <p>Oldest Wallet Name</p>
            </div>
            <div class="summary-card">
                <h3>{{ $newestPayment ? date('d M Y', strtotime($newestPayment->created_at)) : 'N/A' }}</h3>
                <p>Newest Wallet Name</p>
            </div>
        </div>
        
        <!-- Data Table -->
        <table class="data-table">
            <thead>
                <tr>
                    <th width="40" class="text-center">No</th>
                    <th class="text-center">Payment Method</th>
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
                            <div>
                                <div class="payment-name">{{ $payment->name }}</div>
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
        
        <!-- Footer -->
        <div class="footer">
            <p>This report is system-generated at {{ $generated_date }}. For inquiries, please contact system administrator.</p>
            <p>&copy; {{ date('Y') }} Blog Management System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>