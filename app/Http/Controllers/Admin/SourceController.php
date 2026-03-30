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
}