<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Source;
use Illuminate\Validation\Rule;
use PDF;

class SourceController extends Controller 
{
    public function sources_list() {
        $sources = Source::orderBy('id', 'DESC')->get();
        return view('pages.admin.source.sources_list', compact('sources'));
    }

    public function generate_report(Request $request)
    {
        // Validate request
        $request->validate([
            'report_type' => 'required|in:all,date_range',
            'start_date' => 'required_if:report_type,date_range|nullable|date',
            'end_date' => 'required_if:report_type,date_range|nullable|date|after_or_equal:start_date',
            'orientation' => 'required|in:portrait,landscape',
        ]);

        // Get sources with blog counts
        $sources = Source::withCount('blogs')->orderBy('name', 'ASC')->get();
        
        // Get total statistics
        $totalSources = $sources->count();
        $totalBlogs = $sources->sum('blogs_count');
        $averageBlogsPerSource = $totalSources > 0 ? round($totalBlogs / $totalSources, 2) : 0;
        
        // Filter by date range if provided
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        
        if ($request->report_type == 'date_range' && $startDate && $endDate) {
            $sources = Source::withCount(['blogs' => function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            }])->orderBy('name', 'ASC')->get();
            
            $totalBlogs = $sources->sum('blogs_count');
            $averageBlogsPerSource = $totalSources > 0 ? round($totalBlogs / $totalSources, 2) : 0;
        }
        
        // Get top sources by blog count
        $topSources = $sources->sortByDesc('blogs_count')->take(5);
        
        // Prepare data for PDF
        $data = [
            'sources' => $sources,
            'totalSources' => $totalSources,
            'totalBlogs' => $totalBlogs,
            'averageBlogsPerSource' => $averageBlogsPerSource,
            'topSources' => $topSources,
            'generated_date' => now()->format('d F Y H:i:s'),
            'generated_by' => auth()->user()->name ?? 'System Administrator',
            'start_date' => $startDate,
            'end_date' => $endDate,
            'report_type' => $request->report_type,
            'orientation' => $request->orientation,
        ];
        
        // Load view and generate PDF
        $pdf = PDF::loadView('pages.admin.source.source_report_pdf', $data);
        
        // Set paper size and orientation
        $paperSize = 'A4';
        $orientation = $request->orientation == 'landscape' ? 'landscape' : 'portrait';
        $pdf->setPaper($paperSize, $orientation);
        
        // Download PDF with custom filename
        $filename = 'source_report_' . date('Y-m-d_His') . '.pdf';
        
        return $pdf->download($filename);
    }

    public function export_csv(Request $request)
    {
        $sources = Source::withCount('blogs')->orderBy('name', 'ASC')->get();
        
        $filename = 'sources_export_' . date('Y-m-d_His') . '.csv';
        
        $handle = fopen('php://output', 'w');
        
        // Add CSV headers
        fputcsv($handle, ['ID', 'Source Name', 'Total Blogs', 'Created At', 'Last Updated']);
        
        // Add data rows
        foreach($sources as $source) {
            fputcsv($handle, [
                $source->id,
                $source->name,
                $source->blogs_count,
                $source->created_at ? $source->created_at->format('Y-m-d H:i:s') : 'N/A',
                $source->updated_at ? $source->updated_at->format('Y-m-d H:i:s') : 'N/A',
            ]);
        }
        
        fclose($handle);
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        return response()->stream(function() use ($sources) {
            $output = fopen('php://output', 'w');
            fputcsv($output, ['ID', 'Source Name', 'Total Blogs', 'Created At', 'Last Updated']);
            foreach($sources as $source) {
                fputcsv($output, [
                    $source->id,
                    $source->name,
                    $source->blogs_count,
                    $source->created_at ? $source->created_at->format('Y-m-d H:i:s') : 'N/A',
                    $source->updated_at ? $source->updated_at->format('Y-m-d H:i:s') : 'N/A',
                ]);
            }
            fclose($output);
        }, 200, $headers);
    }

    public function add_source() {
        return view('pages.admin.source.add_source');
    }

    public function adding_source(Request $request) {
        $request->validate([
            'name' => 'required|unique:sources,name'
        ], [
            'name.required' => 'Nama Source wajib diisi',
            'name.unique' => 'Source sudah ada'
        ]);

        Source::create([
            'name' => $request->name
        ]);

        return redirect()
            ->route('sources_list')
            ->with('success', 'Source has been added');
    }

    public function edit_source($id) {
        $source = Source::findOrFail($id);
        return view('pages.admin.source.edit_source', compact('source'));
    }

    public function update_source(Request $request, $id) {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('sources', 'name')->ignore($id)
            ]
        ], [
            'name.required' => 'Source Name must be fulfilled',
            'name.unique'   => 'Source has existed'
        ]);

        $source = Source::findOrFail($id);
        $source->update([
            'name' => $request->name 
        ]);

        return redirect()
            ->route('sources_list')
            ->with('success', 'Source has been updated');
    }

    public function delete_source($id) {
        $source = Source::findOrFail($id);

        // Cek apakah source masih dipakai di blogs 
        if($source->blogs()->count() > 0) {
            return redirect()
                ->route('sources_list')
                ->with('error', 'Source "' . $source->name . '" cannot be deleted because it is still used by ' . $source->blogs()->count() . ' blog(s)!');
        }

        $source->delete();

        return redirect()
            ->route('sources_list')
            ->with('success', 'Source "' . $source->name . '" has been deleted');
    }
}