<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        
        $posts = Post::all();
        return PostResource::collection($posts);
    }

    public function page($page) {
        
        $posts = Post::withTrashed()->paginate(5, ['*'], 'page', $page);
        return PostResource::collection($posts);
    }

    public function find($postId) {
        $post = Post::find($postId);
        return new PostResource($post);
    }

    public function store(StorePostRequest $request) {
        $data = $request->all();
        $post = Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
        ]);

        return new PostResource($post);
    }
}
