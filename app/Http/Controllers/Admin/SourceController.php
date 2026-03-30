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

        Genre::create([
            'name' => $request->name
        ]);

        return redirect()
            ->route('sources_list')
            ->with('success', 'Source has been added');
    }

    public function edit_source() {
        return view('pages.admin.source.edit_source');
    }
}