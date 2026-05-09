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
            font-size: 10px;
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
        
        /* Top Users Section */
        .top-users {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fc;
            border-radius: 10px;
            border: 1px solid #1cc88a;
        }
        
        .top-users h3 {
            color: #1cc88a;
            margin-bottom: 15px;
            font-size: 16px;
        }
        
        .top-user-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px;
            background: white;
            border-radius: 5px;
            border: 1px solid #1cc88a;
        }
        
        .user-info {
            flex: 1;
        }
        
        .user-name {
            font-weight: bold;
            font-size: 12px;
        }
        
        .user-email {
            font-size: 10px;
            color: #666;
        }
        
        .blog-count {
            font-size: 11px;
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
                <h3>{{ number_format($totalBlogs, 0, ',', '.') }}</h3>
                <p>Total Blogs</p>
            </div>
            <div class="summary-card">
                <h3>{{ number_format($averageBlogsPerUser, 1, ',', '.') }}</h3>
                <p>Average Blogs/User</p>
            </div>
        </div>
        
        <!-- Users Data Table -->
        <table class="data-table">
            <thead>
                <tr>
                    <th width="30" class="text-center">No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="80">Age</th>
                    <th width="90">Access Level</th>
                    <th width="80">Total Blogs</th>
                    <th width="100">Member Since</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $user->name }}</strong><br>
                        <small style="color:#666">@ {{ $user->username }}</small>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">{{ $user->birthdate ? $user->birthdate->age . ' yrs' : 'N/A' }}</td>
                    <td class="text-center">
                        @php
                            $accessClass = '';
                            switch($user->access) {
                                case 'FREE':
                                    $accessClass = 'badge-secondary';
                                    break;
                                case 'STANDARD':
                                    $accessClass = 'badge-info';
                                    break;
                                case 'PREMIUM':
                                    $accessClass = 'badge-warning';
                                    break;
                                case 'PROFESSIONAL':
                                    $accessClass = 'badge-success';
                                    break;
                                default:
                                    $accessClass = 'badge-secondary';
                            }
                        @endphp
                        <span class="badge {{ $accessClass }}">{{ $user->access }}</span>
                    </td>
                    <td class="text-center">
                        @if($user->blogs_count == 0)
                            <span class="badge badge-secondary">0 Blog</span>
                        @elseif($user->blogs_count == 1)
                            <span class="badge badge-info">{{ $user->blogs_count }} Blog</span>
                        @else
                            <span class="badge badge-success">{{ number_format($user->blogs_count, 0, ',', '.') }} Blogs</span>
                        @endif
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
        
        <!-- Access Level Distribution -->
        @if($totalUsers > 0)
        <div class="stats-section">
            <h3>📊 User Access Level Distribution</h3>
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
                <span class="stat-value">{{ $count }} users ({{ $percentage }}%)</span>
            </div>
            @endforeach
        </div>
        @endif
        
        <!-- Top Users by Blog Count -->
        @if($topUsers->count() > 0)
        <div class="top-users">
            <h3>🏆 Top 5 Active Users (Most Blogs)</h3>
            @foreach($topUsers as $index => $user)
            @if($user->blogs_count > 0)
            <div class="top-user-item">
                <div class="user-info">
                    <div class="user-name">{{ $user->name }}</div>
                    <div class="user-email">{{ $user->email }}</div>
                </div>
                <div class="blog-count">
                    <span class="badge badge-primary">{{ number_format($user->blogs_count, 0, ',', '.') }} blog(s)</span>
                    @php
                        $percentage = $totalBlogs > 0 ? round(($user->blogs_count / $totalBlogs) * 100, 1) : 0;
                    @endphp
                    <small>({{ $percentage }}% of total)</small>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @endif
        
        <!-- Age Group Distribution -->
        @if($totalUsers > 0)
        <div class="stats-section" style="margin-top: 20px; border-color: #f6c23e;">
            <h3>👥 Age Group Distribution</h3>
            <div class="stat-item">
                <span class="stat-label">18-25 years</span>
                <div style="flex: 1; margin: 0 15px;">
                    <div class="progress-bar-container">
                        @php $percentage = $totalUsers > 0 ? round(($ageGroups['18-25'] / $totalUsers) * 100, 1) : 0; @endphp
                        <div class="progress-bar" style="width: {{ $percentage }}%; background-color: #36b9cc;"></div>
                    </div>
                </div>
                <span class="stat-value">{{ $ageGroups['18-25'] }} users ({{ $percentage }}%)</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">26-35 years</span>
                <div style="flex: 1; margin: 0 15px;">
                    <div class="progress-bar-container">
                        @php $percentage = $totalUsers > 0 ? round(($ageGroups['26-35'] / $totalUsers) * 100, 1) : 0; @endphp
                        <div class="progress-bar" style="width: {{ $percentage }}%; background-color: #1cc88a;"></div>
                    </div>
                </div>
                <span class="stat-value">{{ $ageGroups['26-35'] }} users ({{ $percentage }}%)</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">36-50 years</span>
                <div style="flex: 1; margin: 0 15px;">
                    <div class="progress-bar-container">
                        @php $percentage = $totalUsers > 0 ? round(($ageGroups['36-50'] / $totalUsers) * 100, 1) : 0; @endphp
                        <div class="progress-bar" style="width: {{ $percentage }}%; background-color: #f6c23e;"></div>
                    </div>
                </div>
                <span class="stat-value">{{ $ageGroups['36-50'] }} users ({{ $percentage }}%)</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">50+ years</span>
                <div style="flex: 1; margin: 0 15px;">
                    <div class="progress-bar-container">
                        @php $percentage = $totalUsers > 0 ? round(($ageGroups['50+'] / $totalUsers) * 100, 1) : 0; @endphp
                        <div class="progress-bar" style="width: {{ $percentage }}%; background-color: #e74a3b;"></div>
                    </div>
                </div>
                <span class="stat-value">{{ $ageGroups['50+'] }} users ({{ $percentage }}%)</span>
            </div>
        </div>
        @endif
        
        <!-- Email Domain Statistics -->
        @if(count($topDomains) > 0)
        <div class="stats-section" style="margin-top: 20px; border-color: #858796;">
            <h3>📧 Top Email Domains</h3>
            @foreach($topDomains as $domain => $count)
            <div class="stat-item">
                <span class="stat-label">{{ $domain }}</span>
                <div style="flex: 1; margin: 0 15px;">
                    <div class="progress-bar-container">
                        @php $percentage = $totalUsers > 0 ? round(($count / $totalUsers) * 100, 1) : 0; @endphp
                        <div class="progress-bar" style="width: {{ $percentage }}%; background-color: #858796;"></div>
                    </div>
                </div>
                <span class="stat-value">{{ $count }} users ({{ $percentage }}%)</span>
            </div>
            @endforeach
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