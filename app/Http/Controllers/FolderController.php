<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Post;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function index()
    {
        // Mengambil folder beserta postingan dan foto terkait
        $folders = Folder::with('posts.photos')->get(); 
        return view('folders.index', compact('folders'));
    }

    public function create()
    {
        $posts = Post::all(); // Mengambil semua postingan
        return view('folders.create', compact('posts'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'post_ids' => 'required|array', // Postingan harus dipilih
        ]);

        // Membuat folder baru
        $folder = Folder::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Menghubungkan folder dengan postingan yang dipilih
        $folder->posts()->sync($request->post_ids);

        return redirect()->route('folders.index')->with('success', 'Folder successfully created.');
    }

    public function show(Folder $folder)
    {
        // Sudah mendapatkan folder dengan relasinya
        return view('folders.show', compact('folder'));
    }

    public function destroy(Folder $folder)
    {
        $folder->posts()->detach();
        $folder->delete();
        return redirect()->route('folders.index')->with('success', 'Folder successfully deleted.');
    }
}

