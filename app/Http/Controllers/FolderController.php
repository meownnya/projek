<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function index()
    {
        // Mengambil folder yang hanya dimiliki oleh pengguna login beserta postingan dan foto terkait
        $folders = Folder::where('user_id', Auth::id())
            ->with(['posts' => function ($query) {
                $query->where('user_id', Auth::id()); // Pastikan postingan hanya milik pengguna login
            }, 'posts.photos'])
            ->get();

        return view('folders.index', compact('folders'));
    }

    public function create()
    {
        // Mengambil postingan yang hanya dimiliki oleh pengguna login
        $posts = Post::where('user_id', Auth::id())->get();
        return view('folders.create', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'post_ids' => 'required|array', // Postingan harus dipilih
        ]);

        // Membuat folder baru untuk pengguna yang sedang login
        $folder = Folder::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(), // Pastikan folder terhubung dengan pengguna login
        ]);

        // Menghubungkan folder dengan postingan yang dipilih milik pengguna login
        $postIds = Post::whereIn('id', $request->post_ids)
            ->where('user_id', Auth::id()) // Filter postingan berdasarkan pengguna login
            ->pluck('id')
            ->toArray();

        $folder->posts()->sync($postIds);

        return redirect()->route('folders.index')->with('success', 'Folder successfully created.');
    }

    public function show(Folder $folder)
    {
        // Pastikan hanya pengguna login yang dapat melihat folder miliknya
        if ($folder->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan ke folder ini.');
        }

        // Memuat postingan dan foto yang hanya milik pengguna login
        $folder->load(['posts' => function ($query) {
            $query->where('user_id', Auth::id());
        }, 'posts.photos']);

        return view('folders.show', compact('folder'));
    }

    public function destroy(Folder $folder)
    {
        // Pastikan hanya pengguna login yang dapat menghapus folder miliknya
        if ($folder->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan untuk menghapus folder ini.');
        }

        $folder->posts()->detach();
        $folder->delete();

        return redirect()->route('folders.index')->with('success', 'Folder successfully deleted.');
    }
}
