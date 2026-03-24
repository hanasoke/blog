<?php 

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;

class BlogController extends Controller 
{
    public function blogs_data() {
        return view('pages.admin.blog.blogs_data');
    }

    public function add_blog() {
        return view('pages.admin.blog.add_blog');
    }

    public function edit_blog() {
        return view('pages.admin.blog.edit_blog');
    }
}