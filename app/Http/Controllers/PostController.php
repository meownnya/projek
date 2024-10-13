<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('photos')->get(); // Mengambil semua postingan dengan relasi photos
        return view('posts.index', compact('posts'));

    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        //     'music' => 'nullable|mimes:mp3,wav|max:10000',
        //     'photos.*' => 'required|mimes:jpg,jpeg,png|max:10000',
        // ]);

    //     if ($request->hasFile('music')) {
    //         $audioPath = $request->file('music')->store('music', 'public');
    //     }else {
    //         $audioPath = null;
    //     }

    //     $post = Post::create([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'music' => $audioPath,
    //     ]);

    //     if ($request->hasFile('photos')) {
    //         foreach($request->file('photos') as $photo) {
    //             $filename = time().'_'.$photo->getClientOriginalName();
    //             $photo->storeAs('photos', $filename, 'public');

    //         }
    //     Photo::create([
    //         'photo_path' => $filename,
    //         'post_id' => $post->id,
    //     ]);
    //     }

    //     return redirect()->route('posts.index')->with('success', 'Media created successfully.');
    // }

        if($request->hasFile('music')){
            $file=$request->file('music');
            $audioPath=time().'_'.$file->getClientOriginalName();
            $file->move(\public_path('music/'),$audioPath);
        }else {
        $audioPath = null;
                }

        $post =new Post([
            'title' =>$request->title,
            'description' =>$request->description,
            'music' =>$audioPath,
        ]);
       $post->save();

        if($request->hasFile('photos')){
            $files=$request->file('photos');
            foreach($files as $file){
                $filename=time().'_'.$file->getClientOriginalName();
                $request['post_id']=$post->id;
                $request['photo_path']=$filename;
                $file->move(\public_path('/photos'),$filename);
                Photo::create($request->all());

            }
        }

        return redirect()->route('posts.index')->with('success', 'new post added.');

    }

    public function show(string $id)
    {
        $post = Post::with('photos')->findOrFail($id);
        return view('posts.show', compact('post'));
    }


    public function edit(string $id)
    {
         // Temukan postingan berdasarkan ID
        $post = Post::find($id);

        // Mengarahkan ke halaman form edit
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, string $id)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        //     'music' => 'mimes:mp3,wav|max:10000',
        //     'photos.*' => 'mimes:jpg,jpeg,png|max:10000',
        // ]);

        // $post = Post::find($id);

        // if ($request->hasFile('music')) {
        //     $audioPath = $request->file('music')->store('music', 'public');
        // }else {
        //     $audioPath = $post->music;
        // }

        // if ($request->hasFile('photos')) {
        //     foreach($request->file('photos') as $photo) {
        //         $filename = time().'_'.$photo->getClientOriginalName();
        //         $photo->storeAs('photos', $filename, 'public');
        //         Photo::create([
        //             'photo_path' => $filename,
        //             'post_id' => $post->id,
        //         ]);
        //     }}else {
        //         $filename = $post->photos;
        //     }

        //     // Menyimpan data pada tabel posts
        //     $post = new Post();
        //     $post->title = $request->title;
        //     $post->description = $request->description;
        //     $post->music = $audioPath;
        //     $post->save(); // Simpan dulu data post

        //     // Menyimpan data pada tabel photos (tabel relasi)
        //     $photo = new Photo();
        //     $photo->post_id = $post->id; // Menghubungkan ke post yang baru dibuat
        //     $photo->photo_path = $filename; // Menyimpan path foto
        //     $photo->save(); // Simpan data foto

        $post=Post::findOrFail($id);
        if($request->hasFile('music')){
            if (File::exists('music/'.$post->music)) {
                File::delete('music/'.$post->music);
            }
            $file=$request->file('music');
            $post->music=time().'_'.$file->getClientOriginalName();
            $file->move(\public_path('music/'),$post->music);
            $request['music']=$post->music;
        }
   
           $post->update([
            'title' =>$request->title,
            'description' =>$request->description,
            'music' =>$post->music,
           ]);

           if($request->hasFile('photos')){
            $files=$request->file('photos');
            foreach($files as $file){
                $filename=time().'_'.$file->getClientOriginalName();
                $request['post_id']=$post->id;
                $request['photo_path']=$filename;
                $file->move(\public_path('/photos'),$filename);
                Photo::create($request->all());
            }
        }
        

            return redirect()->route('posts.index')->with('success', 'Media updated successfully.');

        }

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
