<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller 
{
    public function index()
    {
        $users = User::where('roles', 'USER')->withCount('blogs')->get();
        return view('pages.admin.users_data.index', compact('users'));
    }

    public function updateAccess(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->access = $request->access;
        $user->save();

        return redirect()->route('users_list')->with('success', 'User access updated successfully!');
    }

    /**
     * Generate PDF report for users
     */
    public function generate_report(Request $request)
    {
        // Validate request
        $request->validate([
            'report_type' => 'required|in:all,date_range',
            'start_date' => 'required_if:report_type,date_range|nullable|date',
            'end_date' => 'required_if:report_type,date_range|nullable|date|after_or_equal:start_date',
            'orientation' => 'required|in:portrait,landscape',
        ]);

        // Get users with blog count
        $query = User::where('roles', 'USER')->withCount('blogs');
        
        // Filter by date range if provided
        if ($request->report_type == 'date_range' && $request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00', 
                $request->end_date . ' 23:59:59'
            ]);
        }
        
        $users = $query->orderBy('created_at', 'desc')->get();
        
        // Get total statistics
        $totalUsers = $users->count();
        $totalBlogs = $users->sum('blogs_count');
        $averageBlogsPerUser = $totalUsers > 0 ? round($totalBlogs / $totalUsers, 2) : 0;
        
        // Count users by access level
        $accessStats = [
            'FREE' => 0,
            'STANDARD' => 0,
            'PREMIUM' => 0,
            'PROFESSIONAL' => 0,
        ];
        
        foreach($users as $user) {
            if(isset($accessStats[$user->access])) {
                $accessStats[$user->access]++;
            }
        }
        
        // Get top users by blog count
        $topUsers = $users->sortByDesc('blogs_count')->take(5);
        
        // Get age distribution
        $ageGroups = [
            '18-25' => 0,
            '26-35' => 0,
            '36-50' => 0,
            '50+' => 0,
        ];
        
        foreach($users as $user) {
            if($user->birthdate) {
                $age = $user->birthdate->age;
                if($age >= 18 && $age <= 25) $ageGroups['18-25']++;
                elseif($age >= 26 && $age <= 35) $ageGroups['26-35']++;
                elseif($age >= 36 && $age <= 50) $ageGroups['36-50']++;
                elseif($age > 50) $ageGroups['50+']++;
            }
        }
        
        // Get newest and oldest user
        $newestUser = $users->first();
        $oldestUser = $users->last();
        
        // Get email domain stats
        $emailDomains = [];
        foreach($users as $user) {
            $domain = substr(strrchr($user->email, "@"), 1);
            if(!isset($emailDomains[$domain])) {
                $emailDomains[$domain] = 0;
            }
            $emailDomains[$domain]++;
        }
        arsort($emailDomains);
        $topDomains = array_slice($emailDomains, 0, 5);
        
        // Prepare data for PDF
        $data = [
            'users' => $users,
            'totalUsers' => $totalUsers,
            'totalBlogs' => $totalBlogs,
            'averageBlogsPerUser' => $averageBlogsPerUser,
            'accessStats' => $accessStats,
            'topUsers' => $topUsers,
            'ageGroups' => $ageGroups,
            'topDomains' => $topDomains,
            'newestUser' => $newestUser,
            'oldestUser' => $oldestUser,
            'generated_date' => now()->format('d F Y H:i:s'),
            'generated_by' => auth()->user()->name ?? 'System Administrator',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'report_type' => $request->report_type,
            'orientation' => $request->orientation,
        ];
        
        // Load view and generate PDF
        $pdf = PDF::loadView('pages.admin.users_data.user_report_pdf', $data);
        
        // Set paper size and orientation
        $paperSize = 'A4';
        $orientation = $request->orientation == 'landscape' ? 'landscape' : 'portrait';
        $pdf->setPaper($paperSize, $orientation);
        
        // Download PDF with custom filename
        $filename = 'user_report_' . date('Y-m-d_His') . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Export users to CSV
     */
    public function export_csv(Request $request)
    {
        $query = User::where('roles', 'USER')->withCount('blogs');
        
        if($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }
        
        $users = $query->orderBy('created_at', 'desc')->get();
        
        $filename = 'users_export_' . date('Y-m-d_His') . '.csv';
        
        return response()->stream(function() use ($users) {
            $output = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Add CSV headers
            fputcsv($output, [
                'ID', 
                'Name', 
                'Username', 
                'Email', 
                'Phone', 
                'Birthdate', 
                'Age', 
                'Access Level', 
                'Total Blogs',
                'Created At', 
                'Last Updated'
            ]);
            
            // Add data rows
            foreach($users as $user) {
                fputcsv($output, [
                    $user->id,
                    $user->name,
                    $user->username,
                    $user->email,
                    $user->phone ?? 'N/A',
                    $user->birthdate ? $user->birthdate->format('Y-m-d') : 'N/A',
                    $user->birthdate ? $user->birthdate->age : 'N/A',
                    $user->access,
                    $user->blogs_count,
                    $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : 'N/A',
                    $user->updated_at ? $user->updated_at->format('Y-m-d H:i:s') : 'N/A',
                ]);
            }
            
            fclose($output);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}