<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class PostController extends Controller
{
    public function index() {
        $posts = Post::withTrashed()->paginate(7);
        return view("posts.index", [
            'posts' => $posts
        ]);
    }

    public function paginate($page) {
        $per_page = 7;
        $posts = Post::withTrashed()->paginate($per_page, ['*'], 'page', $page);
        return view("posts.index", [
            'posts' => $posts
        ]);
    }

    
   
    public function create(){
        $users = User::all();
        return view('posts.create', ['users'=> $users]);
    }

    public function store(StorePostRequest $request){
        
        $data = $request->all();

        // update current post
        if(isset($data['id'])) {

            // update post data
            Post::where('id', $data['id'])->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => $data['post_creator'],
            ]);

            // upload image for this post if provided
            if($request->hasFile('image')) {

                $name = $request->file('image')->getClientOriginalName();
                // dd(base_path('../'), public_path('images'), URL::asset('public/images'));
                // dd($request->file('image'));
                $path = $request->image->store('images');
                // Storage::put("/public/images/".$name, $data['image']);
                // $path = Storage::path("public/images/".$name);
                // ->move(public_path("images/{{$name}}"));
                
                Photo::create([
                    'name'=> $name,
                    'path'=> $path,
                    'post_id' => $data['id']
                ]);
            }
        } 
        // create new post
        else {

            Post::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => $data['post_creator'],
            ]);
        }
        return redirect()->route('posts.index');
    }


    public function show($postId){
        $post = Post::find($postId);
        return view('posts.show', ['post'=> $post]);
    }


    public function edit($postId){
        $users = User::all();
        $post = Post::find($postId);
        return view('posts.create' , ['post'=>$post, 'users'=> $users]);
    }


    public function destroy($postId) {
        Post::where('id', $postId)->delete();
        return redirect()->route('posts.index');  
    }
    
    
    public function restore($postId) {
        Post::where('id', $postId)->restore();
        return redirect()->route('posts.index');  
    }
    
    public function force_destroy($postId) {
        Post::where('id', $postId)->forceDelete();
        return redirect()->route('posts.index');  
    }

    


}
