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

    /* Generate PDF report for genres */
    public function generate_report(Request $request) 
    {
        // Get all genres with their blog counts
        $genres = Genre::withCount('blogs')->orderBy('id', 'DESC')->get();

        // Get total blogs count 
        $totalGenres = $genres->count();
        $totalBlogs = $genres->sum('blogs_count');

        // Get date range if provided 
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Filter by date if provided 
        if($startDate && $endDate) {
            $genres = Genre::withCount(['blogs' => function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }])->orderBy('id', 'DESC')->get();

            $totalBlogs = $genres->sum('blogs_count');
        }

        // Prepare data for PDF 
        $data = [
            'genres' => $genres,
            'totalGenres' => $totalGenres,
            'totalBlogs' => $totalBlogs,
            'generated_date' => now()->format('d F Y H:i:s'),
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        // Load view and generate PDF 
        $pdf = PDF::loadView('pages.admin.genre.genre_report_pdf', $data);

        // Set paper size (optional)
        $pdf->setPaper('A4', 'landscape');

        // Download PDF with custom filename
        $filename = 'genre_report_' . date('Y-m-d_His') . '.pdf';

        return $pdf->download($filename);
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
        $genre = Genre::findOrFail($id);

        // Cek apakah genre masih dipakai di blogs 
        if ($genre->blogs()->count() > 0) {
            return redirect()
                ->route('genre_lists')
                ->with('error', 'Genre "' . $genre->name . '" tidak dapat dihapus karena masih digunakan oleh ' . $genre->blogs()->count() . ' Blog(s)!');
        }

        $genre->delete();

        return redirect()
            ->route('genre_lists')
            ->with('success', 'Genre "' . $genre->name . '" berhasil dihapus');
    }
}

?>