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
        $post=Post::findOrFail($id);
        if($request->hasFile('music')){
            if (File::exists('music/'.$post->music)) {
                File::delete('music/'.$post->music);
            }
            $file=$request->file('music');
            $post->music=time().'_'.$file->getClientOriginalName();
            $file->move(\public_path('music/'),$post->music);
            $request['music']=$post->music;
        }else {
            $post->music = null;
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

    public function deletemusic($id){
        $music=Post::findOrFail($id)->music;
        if (File::exists('music/'.$music)) {
         File::delete('music/'.$music);
    }

    return back()->with('success', 'Music deleted successfully');
    }


    public function deletephoto($id){
        $posts=Photo::findOrFail($id);
        if (File::exists('photos/'.$posts->photo_path)) {
           File::delete('Photos/'.$posts->photo_path);
       }

       Photo::find($id)->delete();
       return back()->with('success', 'Photo deleted successfully');
   }


}
