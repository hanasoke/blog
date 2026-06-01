<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Dashboard Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
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
            border-bottom: 3px solid #4e73df;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #4e73df;
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .header .subtitle {
            color: #666;
            font-size: 12px;
        }
        
        /* Report Info */
        .report-info {
            background: #f8f9fc;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #e3e6f0;
        }
        
        .report-info table {
            width: 100%;
        }
        
        .report-info td {
            padding: 4px;
        }
        
        .report-info td.label {
            font-weight: bold;
            width: 150px;
        }
        
        /* Section Title */
        .section-title {
            background-color: #4e73df;
            color: white;
            padding: 8px 12px;
            margin: 20px 0 15px 0;
            border-radius: 5px;
            font-size: 14px;
        }
        
        /* Summary Cards */
        .summary {
            display: flex;
            margin-bottom: 25px;
            gap: 15px;
        }
        
        .summary-card {
            flex: 1;
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            color: white;
        }
        
        .summary-card:nth-child(2) {
            background: linear-gradient(135deg, #1cc88a 0%, #13855e 100%);
        }
        
        .summary-card:nth-child(3) {
            background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
        }
        
        .summary-card:nth-child(4) {
            background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);
        }
        
        .summary-card h3 {
            font-size: 22px;
            margin-bottom: 5px;
        }
        
        .summary-card p {
            font-size: 10px;
            opacity: 0.9;
        }
        
        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
            font-size: 10px;
        }
        
        .data-table th {
            background-color: #4e73df;
            color: white;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }
        
        .data-table td {
            padding: 6px;
            border: 1px solid #ddd;
        }
        
        .data-table tr:nth-child(even) {
            background-color: #f8f9fc;
        }
        
        /* Two column layout */
        .two-columns {
            display: flex;
            gap: 20px;
            margin: 15px 0;
        }
        
        .column {
            flex: 1;
        }
        
        /* Badge */
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
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
        
        /* Progress bar */
        .progress-bar-container {
            background-color: #e3e6f0;
            border-radius: 10px;
            height: 6px;
            width: 150px;
            overflow: hidden;
        }
        
        .progress-bar {
            background-color: #4e73df;
            height: 100%;
            border-radius: 10px;
        }
        
        /* Footer */
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #999;
            border-top: 1px solid #e3e6f0;
            padding-top: 15px;
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
        
        /* Stat item */
        .stat-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
            padding: 6px;
            background: white;
            border-radius: 5px;
            border: 1px solid #e3e6f0;
        }
        
        .stat-label {
            font-weight: bold;
            font-size: 10px;
        }
        
        .stat-value {
            color: #4e73df;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Dashboard Report</h1>
            <p class="subtitle">Blog Management System - Complete Analytics Report</p>
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
            </table>
        </div>
        
        <!-- Summary Cards -->
        <div class="summary">
            <div class="summary-card">
                <h3>{{ number_format($totalUsers, 0, ',', '.') }}</h3>
                <p>Total Users</p>
            </div>
            <div class="summary-card">
                <h3>{{ number_format($totalBlogs, 0, ',', '.') }}</h3>
                <p>Total Blogs</p>
            </div>
            <div class="summary-card">
                <h3>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                <p>Total Revenue</p>
            </div>
            <div class="summary-card">
                <h3>{{ number_format($pendingTransactions, 0, ',', '.') }}</h3>
                <p>Pending</p>
            </div>
        </div>
        
        <!-- User Statistics Section -->
        <div class="section-title">📊 User Statistics</div>
        <div class="two-columns">
            <div class="column">
                <table class="data-table">
                    <thead>
                        <tr><th>Metric</th><th>Value</th><th>Percentage</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Total Users</td><td>{{ number_format($totalUsers, 0, ',', '.') }}</td><td>100%</td></tr>
                        <tr><td>Admin Users</td><td>{{ number_format($totalAdmin, 0, ',', '.') }}</td>
                            <td>{{ $totalUsers > 0 ? round(($totalAdmin / $totalUsers) * 100, 1) : 0 }}%</td></tr>
                        <tr><td>Regular Users</td><td>{{ number_format($totalRegularUsers, 0, ',', '.') }}</td>
                            <td>{{ $totalUsers > 0 ? round(($totalRegularUsers / $totalUsers) * 100, 1) : 0 }}%</td></tr>
                        <tr><td>Verified Users</td><td>{{ number_format($verifiedUsers, 0, ',', '.') }}</td>
                            <td>{{ $totalUsers > 0 ? round(($verifiedUsers / $totalUsers) * 100, 1) : 0 }}%</td></tr>
                        <tr><td>Unverified Users</td><td>{{ number_format($unverifiedUsers, 0, ',', '.') }}</td>
                            <td>{{ $totalUsers > 0 ? round(($unverifiedUsers / $totalUsers) * 100, 1) : 0 }}%</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="column">
                <table class="data-table">
                    <thead><tr><th>Access Level</th><th>Total</th><th>Percentage</th></tr></thead>
                    <tbody>
                        @foreach($userAccessStats as $level => $count)
                        <tr>
                            <td>{{ $level }}</td>
                            <td>{{ number_format($count, 0, ',', '.') }}</td>
                            <td>{{ $totalUsers > 0 ? round(($count / $totalUsers) * 100, 1) : 0 }}%</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Blog Statistics Section -->
        <div class="section-title">📚 Blog Statistics</div>
        <div class="two-columns">
            <div class="column">
                <table class="data-table">
                    <thead><tr><th>Metric</th><th>Value</th></tr></thead>
                    <tbody>
                        <tr><td>Total Blogs</td><td>{{ number_format($totalBlogs, 0, ',', '.') }}</td></tr>
                        <tr><td>Total Genres</td><td>{{ number_format($totalGenres, 0, ',', '.') }}</td></tr>
                        <tr><td>Total Sources</td><td>{{ number_format($totalSources, 0, ',', '.') }}</td></tr>
                        <tr><td>Access Blogs</td><td>{{ number_format($totalAccessBlogs, 0, ',', '.') }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="column">
                <table class="data-table">
                    <thead><tr><th>Top Genres</th><th>Blogs</th><th>%</th></tr></thead>
                    <tbody>
                        @foreach($genreStats as $genre)
                        <tr>
                            <td>{{ $genre->name }}</td>
                            <td>{{ number_format($genre->blogs_count, 0, ',', '.') }}</td>
                            <td>{{ $totalBlogs > 0 ? round(($genre->blogs_count / $totalBlogs) * 100, 1) : 0 }}%</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Transaction Statistics Section -->
        <div class="section-title">💰 Transaction Statistics</div>
        <div class="two-columns">
            <div class="column">
                <table class="data-table">
                    <thead><tr><th>Status</th><th>Count</th><th>Revenue</th></tr></thead>
                    <tbody>
                        <tr><td><span class="badge badge-warning">Pending</span></td>
                            <td>{{ number_format($pendingTransactions, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($pendingRevenue, 0, ',', '.') }}</td></tr>
                        <tr><td><span class="badge badge-success">Approved</span></td>
                            <td>{{ number_format($approvedTransactions, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td></tr>
                        <tr><td><span class="badge badge-danger">Rejected</span></td>
                            <td>{{ number_format($rejectedTransactions, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($rejectedRevenue, 0, ',', '.') }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="column">
                <table class="data-table">
                    <thead><tr><th>Member Packages</th><th>Access Blogs</th></tr></thead>
                    <tbody>
                        @foreach($memberStats as $member)
                        <tr><td>{{ $member->name }}</td><td>{{ number_format($member->access_blog_count, 0, ',', '.') }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Monthly Statistics Section -->
        <div class="section-title">📈 Monthly Statistics (Last 6 Months)</div>
        <div class="two-columns">
            <div class="column">
                <table class="data-table">
                    <thead><tr><th>Month</th><th>New Users</th></tr></thead>
                    <tbody>
                        @foreach($monthlyUserStats as $month => $count)
                        <tr><td>{{ $month }}</td><td>{{ number_format($count, 0, ',', '.') }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="column">
                <table class="data-table">
                    <thead><tr><th>Month</th><th>Transactions</th><th>Revenue</th></tr></thead>
                    <tbody>
                        @foreach($monthlyTransactionStats as $month => $data)
                        <tr>
                            <td>{{ $month }}</td>
                            <td>{{ number_format($data['count'], 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($data['revenue'], 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Latest Blogs Section -->
        @if($latestBlogs->count() > 0)
        <div class="section-title">📝 Latest Blogs</div>
        <table class="data-table">
            <thead>
                <tr><th>Title</th><th>Author</th><th>Genre</th><th>Source</th><th>Date</th></tr>
            </thead>
            <tbody>
                @foreach($latestBlogs as $blog)
                <tr>
                    <td>{{ Str::limit($blog->title, 40) }}</td>
                    <td>{{ $blog->user->name ?? 'N/A' }}</td>
                    <td>{{ $blog->genre->name ?? 'N/A' }}</td>
                    <td>{{ $blog->source->name ?? 'N/A' }}</td>
                    <td>{{ $blog->created_at ? $blog->created_at->format('d M Y') : 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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