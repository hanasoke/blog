<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sources Report</title>
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
            border-radius: 3px;
            font-size: 11px;
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
        
        .badge-info {
            background-color: #858796;
            color: white;
        }
        
        /* Top Sources Section */
        .top-sources {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fc;
            border-radius: 10px;
            border: 1px solid #8a8a8aff;
        }
        
        .top-sources h3 {
            color: #36b9cc;
            margin-bottom: 15px;
            font-size: 16px;
        }
        
        .top-source-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 8px;
            background: white;
            border-radius: 5px;
            border: 1px solid #0077ffff;
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
            <h1>Sources Report</h1>
            <p class="subtitle">Blog Management System - Source Analytics Report</p>
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
                <h3>{{ $totalSources }}</h3>
                <p>Total Sources</p>
            </div>
            <div class="summary-card">
                <h3>{{ number_format($totalBlogs, 0, ',', '.') }}</h3>
                <p>Total Blogs</p>
            </div>
            <div class="summary-card">
                <h3>{{ number_format($averageBlogsPerSource, 1, ',', '.') }}</h3>
                <p>Average Blogs/Source</p>
            </div>
        </div>
        
        <!-- Data Table -->
        <table class="data-table">
            <thead>
                <tr>
                    <th width="40" class="text-center">No</th>
                    <th>Source Name</th>
                    <th width="120" class="text-center">Total Blogs</th>
                    <th width="130" class="text-center">Created At</th>
                    <th width="130" class="text-center">Last Updated</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sources as $index => $source)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $source->name }}</strong>
                    </td>
                    <td class="text-center">
                        @if($source->blogs_count == 1)
                            <span class="badge badge-warning">{{ number_format($source->blogs_count, 0, ',', '.') }} Blog</span>
                        @elseif($source->blogs_count > 1)
                            <span class="badge badge-success">{{ number_format($source->blogs_count, 0, ',', '.') }} Blogs</span>
                        @else
                            <span class="badge badge-info">0 Blog</span>
                        @endif
                    </td>
                    <td class="text-center">{{ $source->created_at ? date('d M Y H:i', strtotime($source->created_at)) : 'N/A' }}</td>
                    <td class="text-center">{{ $source->updated_at ? date('d M Y H:i', strtotime($source->updated_at)) : 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No sources found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <!-- Top Sources Section -->
        @if($topSources->count() > 0)
        <div class="top-sources">
            <h3>Top 5 Sources by Blog Count</h3>
            @foreach($topSources as $index => $source)
            <div class="top-source-item">
                <div class="source-info">
                    <div class="source-name">{{ $source->name }}</div>
                    <div class="blog-count">{{ number_format($source->blogs_count, 0, ',', '.') }} blog(s)</div>
                </div>
                <div class="stat">
                    @php
                        $percentage = $totalBlogs > 0 ? round(($source->blogs_count / $totalBlogs) * 100, 1) : 0;
                    @endphp
                    <span class="badge badge-primary">{{ $percentage }}% of total</span>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        
        <!-- Footer -->
        <div class="footer">
            <p>This report is system-generated at {{ $generated_date }}. For inquiries, please contact system administrator.</p>
            <p>&copy; {{ date('Y') }} Blog Management System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>