<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::get();  // Get all the results
        $posts = Post::paginate(2);
        
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        Post::create([
            'body' => $request->body,
            'user_id' => auth()->user()->id
        ]);
        
        return back();
    }

}
