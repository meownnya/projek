<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Folder;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Cari di dalam folder berdasarkan title atau description
        $folders = Folder::where('title', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->get();

        // Cari di dalam posts berdasarkan title atau description
        $posts = Post::where('title', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->get();

        // Kirim hasil pencarian ke view
        return view('search.results', compact('folders', 'posts', 'query'));
    }
}

