<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Genre;

class DashboardController extends Controller
{
    public function index() {
        return view('pages.admin.base');
    }

    public function blogs_data() {
        return view('pages.admin.blogs_data');
    }

    public function add_blog() {
        return view('pages.admin.add_blog');
    }
    
    public function add_genre() {
        return view('pages.admin.add_genre');
    }

    public function store_genre(Request $request) {
        $request->validate([
            'name' => 'required'
        ]);

        Genre::create([
            'name'=> $request->name
        ]);

        return redirect()
            ->route('genre_lists')
            ->with('success', 'Genre berhasil ditambahkan');
    }

    public function edit_genre($id) {
        $genre = Genre::findOrFail($id);
        return view('pages.admin.edit_genre', compact('genre'));
    }

    public function update_genre(Request $request, $id) {
        $request->validate([
            'name' => 'required' 
        ]);

        $genre = Genre::findOOrFail($id);
        $genre->update([
            'name' => $request->name 
        ]);

        return redirect()
            ->route('genre_lists')
            ->with('success', 'Genre berhasil diupdate');
    }

    public function delete_genre($id) {
        Genre::findOrFail($id)->delete();

        return redirect()
            ->route('genre_lists')
            ->with('success', 'Genre berhasil dihapus');
    }

    public function genre_lists() {
        $genres = Genre::orderBy('id', 'DESC')->get();
        return view('pages.admin.genre_lists', compact('genres'));
    }
}
