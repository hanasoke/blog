<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use App\AccessBlog;
use Illuminate\Validation\Rule;
use PDF;

class MemberController extends Controller 
{
    public function index() {
        $members = Member::orderBy('id', 'DESC')->get();
        return view('pages.admin.members.index', compact('members'));
    }
    
    public function add_member() {
        return view('pages.admin.members.add_member');
    }

    public function save_member(Request $request) {
        $request->validate([
            'name' => 'required|unique:members,name',
            'price' => 'required|numeric|min:1'
        ], [
            'name.required' => 'Membership Grade must be filled',
            'name.unique' => 'Membership Grade has existed',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number'
        ]);

        Member::create([
            'name'  => $request->name,
            'price' => $request->price
        ]);

        return redirect()
            ->route('members')
            ->with('success', 'Membership Grade has been added');

    }

    public function edit_member($id) {
        $member = Member::findOrFail($id);
        return view('pages.admin.members.edit_member', compact('member'));
    }

    public function update_member(Request $request, $id) {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('members', 'name')->ignore($id)
            ],
            'price' => 'required|integer|min:0',   
        ], [
            'name.required' => 'Membership Grade must be filled',
            'name.unique' => 'Membership Grade has existed',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number'
        ]);

        $member = Member::findOrFail($id);
        $member->update([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return redirect()
            ->route('members')
            ->with('success', 'Membership Grade has been updated');
    }

    public function delete_member($id) {
        $member = Member::findOrFail($id); 

        // Cek apakah member masih memiliki relasi dengan access_blog 
        $accessCount = AccessBlog::where('member_id', $id)->count();

        if($accessCount > 0) {
            // Jika masih ada relasi, tampilkan error dan batalkan penghapusan 
            return redirect()
                ->route('members')
                ->with('error', 'Cannot delete "' . $member->name . '" member because it is still used by ' . $accessCount . ' blog(s). Please delete the blog access first!');
        }

        $member->delete();

        return redirect()
            ->route('members')
            ->with('success', $member->name . ' Member has been deleted');
    }

    public function generateReport()
    {
        // Get all members data 
        $members = Member::orderBy('name', 'ASC')->get();

        // Get total members count 
        $totalMembers = $members->count();

        // Get total price sum 
        $totalPrice = $members->sum('price');

        // Prepare data for view 
        $data = [
            'members' => $members,
            'totalMembers' => $totalMembers,
            'totalPrice' => $totalPrice,
            'generatedDate' => now()->format('d F Y H:i:s'),
            'generatedBy' => auth()->user()->name ?? 'Admin',
        ];

        // Load view and convert to PDF 
        $pdf = PDF::loadView('pages.admin.members.report_pdf', $data);

        // Set paper size (A4, Landscape/Portrait)
        $pdf->setPaper('A4', 'landscape');

        // Download PDF with custom filename 
        return $pdf->stream('members_report_' . date('Y-m-d_His') . '.pdf');
    }
}

?>