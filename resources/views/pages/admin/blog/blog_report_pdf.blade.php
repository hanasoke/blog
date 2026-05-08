<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Blogs Report</title>
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
            color: #4e73df;
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
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .summary-card h3 {
            font-size: 32px;
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
            font-size: 10px;
        }
        
        .data-table th {
            background-color: #4e73df;
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
            padding: 3px 10px;
            border-radius: 12px;
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
            color: white;
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
        
        /* Stats Section */
        .stats-section {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fc;
            border-radius: 10px;
            border: 1px solid #e3e6f0;
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
            padding: 8px;
            background: white;
            border-radius: 5px;
            margin-bottom: 8px;
            border-left: 3px solid #4e73df;
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
        
        /* Blog title link */
        .blog-title {
            font-weight: bold;
            font-size: 11px;
            color: #4e73df;
        }
        
        .blog-meta {
            font-size: 9px;
            color: #666;
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
            @if(file_exists(public_path('img/logo.png')))
                <img src="{{ public_path('img/logo.png') }}" class="logo" alt="Logo">
            @endif
            <h1>Blog Content Report</h1>
            <p class="subtitle">Blog Management System - Content Analytics Report</p>
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
                <h3>{{ $totalBlogs }}</h3>
                <p>Total Blogs</p>
            </div>
            <div class="summary-card">
                <h3>{{ $totalGenres }}</h3>
                <p>Total Genres</p>
            </div>
            <div class="summary-card">
                <h3>{{ $totalSources }}</h3>
                <p>Total Sources</p>
            </div>
            <div class="summary-card">
                <h3>{{ $totalAuthors }}</h3>
                <p>Total Authors</p>
            </div>
        </div>
        
        <!-- Data Table -->
        <table>
            <thead>
                <tr>
                    <th width="30" class="text-center">No</th>
                    <th width="200">Blog Title</th>
                    <th width="80">Genre</th>
                    <th width="80">Source</th>
                    <th width="80">Access</th>
                    <th width="100">Author</th>
                    <th width="100">Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $index => $blog)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <div class="blog-title">{{ Str::limit($blog->title, 50) }}</div>
                        <div class="blog-meta">ID: #{{ $blog->id }}</div>
                    </td>
                    <td>{{ $blog->genre->name ?? '-' }}</td>
                    <td>{{ $blog->source->name ?? '-' }}</td>
                    <td class="text-center">
                        @if($blog->access && $blog->access->member)
                            @php
                                $accessClass = '';
                                switch($blog->access->member->name) {
                                    case 'BASIC':
                                        $accessClass = 'badge-success';
                                        break;
                                    case 'PREMIUM':
                                        $accessClass = 'badge-warning';
                                        break;
                                    case 'VIP':
                                        $accessClass = 'badge-danger';
                                        break;
                                    default:
                                        $accessClass = 'badge-secondary';
                                }
                            @endphp
                            <span class="badge {{ $accessClass }}">{{ $blog->access->member->name }}</span>
                        @else
                            <span class="badge badge-secondary">No Access</span>
                        @endif
                    </td>
                    <td>{{ $blog->user->name ?? '-' }}</td>
                    <td>{{ $blog->created_at ? date('d M Y', strtotime($blog->created_at)) : 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No blogs found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <!-- Blog Statistics Section -->
        @if($blogs->count() > 0)
        <div class="stats-section">
            <h3>📊 Blog Statistics</h3>
            <div class="stat-item">
                <span class="stat-label">Total Blogs by Access Level:</span>
                <span class="stat-value">Basic: {{ $basicCount }} | Premium: {{ $premiumCount }} | VIP: {{ $vipCount }} | No Access: {{ $noAccessCount }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Newest Blog:</span>
                <span class="stat-value">{{ $newestBlog ? $newestBlog->title : 'N/A' }} ({{ $newestBlog ? date('d M Y', strtotime($newestBlog->created_at)) : 'N/A' }})</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Oldest Blog:</span>
                <span class="stat-value">{{ $oldestBlog ? $oldestBlog->title : 'N/A' }} ({{ $oldestBlog ? date('d M Y', strtotime($oldestBlog->created_at)) : 'N/A' }})</span>
            </div>
            
            @if(count($topGenres) > 0)
            <div class="stat-item" style="flex-direction: column; align-items: flex-start;">
                <span class="stat-label" style="margin-bottom: 10px;">Top 5 Genres:</span>
                @foreach($topGenres as $genreName => $count)
                <div style="width: 100%; margin-bottom: 8px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 3px;">
                        <span>{{ $genreName }}</span>
                        <span>{{ $count }} blogs ({{ round(($count / $totalBlogs) * 100, 1) }}%)</span>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress-bar" style="width: {{ ($count / $totalBlogs) * 100 }}%;"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
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