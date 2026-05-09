<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Users Report</title>
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
            border-bottom: 2px solid #4e73df;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #4e73df;
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
            background: #fff;
            border: 1px solid #e3e6f0;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
        }
        
        .summary-card h3 {
            font-size: 28px;
            color: #4e73df;
            margin-bottom: 5px;
        }
        
        .summary-card p {
            color: #666;
            font-size: 12px;
        }
        
        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .data-table th {
            background-color: #4e73df;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
            font-size: 11px;
        }
        
        .data-table td {
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 10px;
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
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }
        
        .badge-primary {
            background-color: #4e73df;
            color: white;
        }
        
        .badge-success {
            background-color: #1cc88a;
            color: white;
        }
        
        .badge-warning {
            background-color: #f6c23e;
            color: #333;
        }
        
        .badge-danger {
            background-color: #e74a3b;
            color: white;
        }
        
        .badge-info {
            background-color: #36b9cc;
            color: white;
        }
        
        .badge-secondary {
            background-color: #858796;
            color: white;
        }
        
        /* Stats Sections */
        .stats-section {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fc;
            border-radius: 10px;
            border: 1px solid #4e73df;
        }
        
        .stats-section h3 {
            color: #4e73df;
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
            color: #4e73df;
            font-weight: bold;
            font-size: 12px;
        }
        
        /* Progress bar */
        .progress-bar-container {
            background-color: #e3e6f0;
            border-radius: 10px;
            height: 8px;
            width: 200px;
            overflow: hidden;
        }
        
        .progress-bar {
            background-color: #4e73df;
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
        
        /* Footer */
        .footer {
            margin: 30px 0 10px 0;
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
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Users Report</h1>
            <p class="subtitle">Blog Management System - User Analytics Report</p>
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
                <h3>{{ $totalUsers }}</h3>
                <p>Total Users</p>
            </div>
            <div class="summary-card">
                <h3>{{ $verifiedUsers }}</h3>
                <p>Verified Users</p>
            </div>
            <div class="summary-card">
                <h3>{{ $verificationRate }}%</h3>
                <p>Verification Rate</p>
            </div>
        </div>
        
        <!-- Users Data Table -->
        <table class="data-table">
            <thead>
                <tr>
                    <th width="30" class="text-center">No</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th width="60" class="text-center">Age</th>
                    <th width="80" class="text-center">Access Level</th>
                    <th width="100" class="text-center">Registered Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">{{ $user->birthdate ? $user->birthdate->age . ' yrs' : 'N/A' }}</td>
                    <td class="text-center">
                        @php
                            $accessClass = '';
                            switch($user->access) {
                                case 'BASIC': $accessClass = 'badge-success'; break;
                                case 'PREMIUM': $accessClass = 'badge-warning'; break;
                                case 'VIP': $accessClass = 'badge-primary'; break;
                                default: $accessClass = 'badge-secondary';
                            }
                        @endphp
                        <span class="badge {{ $accessClass }}">{{ $user->access }}</span>
                    </td>
                    <td class="text-center">{{ $user->created_at ? date('d M Y', strtotime($user->created_at)) : 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <!-- Two Columns for Statistics -->
        <div class="two-columns">
            <!-- Left Column -->
            <div class="column">
                <!-- Access Level Distribution -->
                @if($totalUsers > 0)
                <div class="stats-section" style="margin-bottom: 20px;">
                    <h3>Access Level Distribution</h3>
                    @foreach($accessStats as $level => $count)
                    @php
                        $percentage = $totalUsers > 0 ? round(($count / $totalUsers) * 100, 1) : 0;
                    @endphp
                    <div class="stat-item">
                        <span class="stat-label">{{ $level }}</span>
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
                
                <!-- Age Group Distribution -->
                @if($totalUsers > 0)
                <div class="stats-section" style="border-color: #1cc88a;">
                    <h3>Age Group Distribution</h3>
                    @foreach($ageGroups as $group => $count)
                    @php
                        $percentage = $totalUsers > 0 ? round(($count / $totalUsers) * 100, 1) : 0;
                        $barColor = '';
                        switch($group) {
                            case 'Under 18': $barColor = '#e74a3b'; break;
                            case '18-25': $barColor = '#f6c23e'; break;
                            case '26-35': $barColor = '#1cc88a'; break;
                            case '36-50': $barColor = '#36b9cc'; break;
                            case '50+': $barColor = '#4e73df'; break;
                            default: $barColor = '#858796';
                        }
                    @endphp
                    <div class="stat-item">
                        <span class="stat-label">{{ $group }}</span>
                        <div style="flex: 1; margin: 0 15px;">
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: {{ $percentage }}%; background-color: {{ $barColor }};"></div>
                            </div>
                        </div>
                        <span class="stat-value">{{ $count }} ({{ $percentage }}%)</span>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            
            <!-- Right Column -->
            <div class="column">
                <!-- Monthly Registration Trends -->
                <div class="stats-section" style="margin-bottom: 20px; border-color: #f6c23e;">
                    <h3>Monthly Registration Trends</h3>
                    @foreach($monthlyStats as $month => $count)
                    @php
                        $maxCount = max($monthlyStats) ?: 1;
                        $percentage = ($count / $maxCount) * 100;
                    @endphp
                    <div class="stat-item">
                        <span class="stat-label">{{ $month }}</span>
                        <div style="flex: 1; margin: 0 15px;">
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: {{ $percentage }}%; background-color: #f6c23e;"></div>
                            </div>
                        </div>
                        <span class="stat-value">{{ $count }} users</span>
                    </div>
                    @endforeach
                </div>
                
                <!-- Top Email Domains -->
                @if(count($topDomains) > 0)
                <div class="stats-section" style="border-color: #858796;">
                    <h3>Top Email Domains</h3>
                    @foreach($topDomains as $domain => $count)
                    @php
                        $percentage = $totalUsers > 0 ? round(($count / $totalUsers) * 100, 1) : 0;
                    @endphp
                    <div class="stat-item">
                        <span class="stat-label">{{ $domain }}</span>
                        <div style="flex: 1; margin: 0 15px;">
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: {{ $percentage }}%; background-color: #858796;"></div>
                            </div>
                        </div>
                        <span class="stat-value">{{ $count }} ({{ $percentage }}%)</span>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        
        <!-- User Summary Info -->
        <div class="stats-section" style="margin-top: 20px;">
            <h3>User Summary Information</h3>
            <div class="stat-item">
                <span class="stat-label">Newest User:</span>
                <span class="stat-value">{{ $newestUser ? $newestUser->name . ' (' . date('d M Y', strtotime($newestUser->created_at)) . ')' : 'N/A' }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Oldest User:</span>
                <span class="stat-value">{{ $oldestUser ? $oldestUser->name . ' (' . date('d M Y', strtotime($oldestUser->created_at)) . ')' : 'N/A' }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Email Verified Users:</span>
                <span class="stat-value">{{ $verifiedUsers }} of {{ $totalUsers }} ({{ $verificationRate }}%)</span>
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