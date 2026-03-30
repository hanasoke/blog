<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Genre;
use Illuminate\Validation\Rule;

class SourceController extends Controller 
{
    public function sources_list() {
        return view('pages.admin.source.sources_list');
    }

    public function add_source() {
        return view('pages.admin.source.add_source');
    }

    public function edit_source() {
        return view('pages.admin.source.edit_source');
    }
}