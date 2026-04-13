<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Source;
use Illuminate\Validation\Rule;

class SourceController extends Controller 
{
    public function sources_list() {
        $sources = Source::orderBy('id', 'DESC')->get();
        return view('pages.admin.source.sources_list', compact('sources'));
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