<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Genre;
use Illuminate\Validation\Rule;

class GenreController extends Controller 
{
    public function genre_lists() {
        $genres = Genre::orderBy('id', 'DESC')->get();
        return view('pages.admin.genre.genre_lists', compact('genres'));
    }
    
    public function add_genre() {
        return view('pages.admin.genre.add_genre');
    }

    public function store_genre(Request $request) {
        $request->validate([
            'name' => 'required|unique:genres,name'
        ], [
            'name.required' => 'Nama genre wajib diisi',
            'name.unique' => 'Genre sudah ada'
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
        return view('pages.admin.genre.edit_genre', compact('genre'));
    }

    public function update_genre(Request $request, $id) {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('genres', 'name')->ignore($id)
            ] 
        ], [
            'name.required' => 'Nama genre wajib diisi',
            'name.unique'   => 'Genre sudah ada'
        ]);

        $genre = Genre::findOrFail($id);
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
}

?>