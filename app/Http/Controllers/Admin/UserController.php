<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use PDF; // Import PDF facade

class UserController extends Controller 
{
    public function index()
    {
        $users = User::where('roles', 'USER')->get();
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
        
    }

    /**
     * Export users to CSV
     */
    public function export_csv(Request $request)
    {
        $query = User::where('roles', 'USER');
        
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