<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('photos')->get(); // Mengambil semua postingan dengan relasi photos
        return view('posts.index', compact('posts'));

        // $posts = Post::findOrFail($photo->post_id);
        // return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'music' => 'nullable|file|mimes:mp3,wav',
            'photos.*' => 'required|file|mimes:jpeg,png,jpg,mp4,mov,avi',
        ]);

    
        // Simpan postingan
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'music' => $request->file('music')->store('music', 'public'),
        ]);
    
        // Simpan foto-foto
        // if($request->hasFile('photos')) {
        //     foreach ($request->file('photos') as $photo) {
        //         $photoPath = $photo->store('photos');
        //         Photo::create([
        //             'photo_path' => $photoPath,
        //             'post_id' => $posts->id,
        //         ]);
        //     }
        // }

        if ($request->hasFile('photos')) {
            foreach($request->file('photos') as $photo) {
                $filename = time().'_'.$photo->getClientOriginalName();
                $photo->storeAs('photos', $filename, 'public');
                Photo::create([
                    'photo_path' => $filename,
                    'post_id' => $post->id,
                ]);
            }
        }
    
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with('photos')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         // Temukan postingan berdasarkan ID
        $post = Post::find($id);

        // Mengarahkan ke halaman form edit
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Temukan postingan berdasarkan ID
    $post = Post::findOrFail($id);

    // Validasi input
    $validated = $request->validate([
        'title' => 'required',
        'description' => 'nullable',
        'music' => 'required|file|mimes:mp3,wav',
        'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif',
    ]);

    // Update postingan
    $post->update([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'photo_path' => $request->file('photos') ? $request->file('photos')->store('photos') : $post->photo_path,
        'music' => $request->file('music') ? $request->file('music')->store('music') : $post->music,
    ]);

    // Tambahkan foto baru jika ada
    // if ($request->hasFile('photos')) {
    //     foreach ($request->file('photos') as $photo) {
    //         $photoPath = $photo->store('photos');
    //         Photo::create([
    //             'photo_path' => $photoPath,
    //             'post_id' => $post->id,
    //         ]);
    //     }
    // }

    if ($request->hasFile('photos')) {
        foreach($request->file('photos') as $photo) {
            $filename = time().'_'.$photo->getClientOriginalName();
            $photo->storeAs('photos', $filename, 'public');
            Photo::create([
                'photo_path' => $filename,
                'post_id' => $post->id,
            ]);
        }
    }

    // Redirect ke halaman show dengan pesan sukses
    return redirect()->route('posts.show', $post->id)->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan postingan berdasarkan ID
        $post = Post::findOrFail($id);

        // Hapus postingan
        $post->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
