<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // Hanya ambil postingan milik pengguna yang login
        $posts = Post::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'music' => 'nullable|mimes:mp3,wav,mpeg|max:10000',
            'photos' => 'required',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Buat postingan baru milik pengguna login
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->input('title');
        $post->description = $request->input('description');

        if ($request->hasFile('music')) {
            $musicName = time() . '-' . $request->music->getClientOriginalName();
            Storage::putFileAs('uploads/music', $request->music, $musicName);
            $post->music = $musicName;
        }

        $post->save();

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                Storage::putFileAs('uploads/photos', $file, $filename);

                Photo::create([
                    'post_id' => $post->id,
                    'photo_path' => $filename,
                ]);
            }
        }

        return redirect()->route('posts.index')->with('success', 'New memories added.');
    }

    public function show(string $id)
    {
        $post = Post::with('photos')->where('user_id', Auth::id())->findOrFail($id);

        return view('posts.show', compact('post'));
    }

    public function edit(string $id)
    {
        $post = Post::where('user_id', Auth::id())->findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'music' => 'nullable|mimes:mp3,wav,mpeg|max:10000',
            'photos' => 'nullable',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = Post::where('user_id', Auth::id())->findOrFail($id);

        if ($request->hasFile('music')) {
            if ($post->music && Storage::exists('uploads/music/' . $post->music)) {
                Storage::delete('uploads/music/' . $post->music);
            }

            $musicName = time() . '-' . $request->music->getClientOriginalName();
            Storage::putFileAs('uploads/music', $request->music, $musicName);
            $post->music = $musicName;
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                Storage::putFileAs('uploads/photos', $file, $filename);

                Photo::create([
                    'post_id' => $post->id,
                    'photo_path' => $filename,
                ]);
            }
        }

        return back()->with('success', 'Post updated successfully.');
    }

    public function destroy(string $id)
    {
        $post = Post::where('user_id', Auth::id())->findOrFail($id);

        if ($post->music && Storage::exists('uploads/music/' . $post->music)) {
            Storage::delete('uploads/music/' . $post->music);
        }

        foreach ($post->photos as $photo) {
            if (Storage::exists('uploads/photos/' . $photo->photo_path)) {
                Storage::delete('uploads/photos/' . $photo->photo_path);
            }
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    public function deletemusic($id)
    {
        $post = Post::where('user_id', Auth::id())->findOrFail($id);

        if (Storage::exists('uploads/music/' . $post->music)) {
            Storage::delete('uploads/music/' . $post->music);
        }

        $post->update(['music' => null]);

        return back()->with('success', 'Music deleted successfully.');
    }

    public function deletephoto($id)
    {
        $photo = Photo::findOrFail($id);

        if (Photo::where('post_id', $photo->post_id)->count() <= 1) {
            return back()->with('error', 'You cannot delete all photos.');
        }

        if (Storage::exists('uploads/photos/' . $photo->photo_path)) {
            Storage::delete('uploads/photos/' . $photo->photo_path);
        }

        $photo->delete();

        return back()->with('success', 'Photo successfully deleted.');
    }

    public function addmusic(Request $request, $id)
    {
        $request->validate([
            'music' => 'required|mimes:mp3,wav,mpeg|max:10000',
        ]);

        $post = Post::where('user_id', Auth::id())->findOrFail($id);

        if ($request->hasFile('music')) {
            $file = $request->file('music');
            $musicName = time() . '-' . $file->getClientOriginalName();
            Storage::putFileAs('uploads/music', $file, $musicName);
            $post->update(['music' => $musicName]);

            return back()->with('success', 'Music successfully added.');
        }

        return back()->withErrors('Failed to upload music.');
    }

    public function addphotos(Request $request, $id)
    {
        $request->validate([
            'photos' => 'required',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = Post::where('user_id', Auth::id())->findOrFail($id);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                Storage::putFileAs('uploads/photos', $file, $filename);

                Photo::create([
                    'post_id' => $post->id,
                    'photo_path' => $filename,
                ]);
            }
        }

        return back()->with('success', 'Photos added successfully.');
    }
}
