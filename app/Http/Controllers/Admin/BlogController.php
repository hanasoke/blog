<?php 

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Blog;
use App\Genre;
use App\Source;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller 
{
    public function blogs_data() {
        $blogs = Blog::with(['genre', 'source'])->orderBy('created_at', 'desc')->get();

        return view('pages.admin.blog.blogs_data', compact('blogs'));
    }

    public function add_blog() {
        $genres = Genre::orderBy('name')->get();
        $sources = Source::orderBy('name')->get();
        return view('pages.admin.blog.add_blog', compact('genres', 'sources'));
    }

    public function edit_blog() {
        return view('pages.admin.blog.edit_blog');
    }
}