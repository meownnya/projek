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
        // $posts = Post::with('photos')->get(); // Mengambil semua postingan dengan relasi photos
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', compact('posts'));

    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {

        // Simpan post ke database
        $post = new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');

        // Cek jika ada file musik yang diupload
        if ($request->hasFile('music')) {
            $musicFile = $request->file('music');
            $musicName = time() . '-' . $musicFile->getClientOriginalName();
            $musicFile->move(public_path('music'), $musicName); // Simpan musik ke folder public/music
            $post->music = $musicName; // Simpan nama file musik di database
        }

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
        $post=Post::findOrFail($id);
        if($request->hasFile('music')){
            if (File::exists('music/'.$post->music)) {
                File::delete('music/'.$post->music);
            }

            $musicFile = $request->file('music');
            $musicName = time() . '-' . $musicFile->getClientOriginalName();
            $musicFile->move(public_path('music'), $musicName); // Simpan musik ke folder public/music
            $post->music = $musicName; // Simpan nama file musik di database
        }else{
            $post->music=$post->music;
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
        $posts=Post::findOrFail($id);

         if (File::exists('music/'.$posts->music)) {
             File::delete('music/'.$posts->music);
         }
         $photos=Photo::where('post_id',$posts->id)->get();
         foreach($photos as $image){
         if (File::exists('photos/'.$image->photo_path)) {
            File::delete('photos/'.$image->photo_path);
        }
         }
         $posts->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

    // public function deletemusic($id){
    //     $music=Post::findOrFail($id)->music;
    //     if (File::exists('music/'.$music)) {
    //      File::delete('music/'.$music);
    // }

    // return back()->with('success', 'Music deleted successfully');
    // }


    public function deletephoto($id){
    
    // Temukan foto yang akan dihapus
    $photo = Photo::findOrFail($id);

    // Cek jumlah total foto yang terkait dengan post yang sama
    $photoCount = Photo::where('post_id', $photo->post_id)->count();

    // Jika foto hanya tersisa 1, beri peringatan dan jangan hapus foto
    if ($photoCount <= 1) {
        return back()->with('error', 'Minimal satu foto harus tersisa. Anda tidak dapat menghapus semua foto.');
    }

    // Jika lebih dari 1 foto, lanjutkan proses penghapusan
    if (File::exists('photos/'.$photo->photo_path)) {
        File::delete('photos/'.$photo->photo_path); // Hapus file dari folder
    }
 
    // Hapus record foto dari database
    $photo->delete();

    return back()->with('success', 'Foto berhasil dihapus.');


    }


}
