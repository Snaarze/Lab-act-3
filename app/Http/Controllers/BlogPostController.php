<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    // Show the form for creating a new blog post
    public function create()
    {
        return view('create');
    }

    // Store a newly created blog post
    public function store(Request $request)
    {
        // Validate blog post form input
        $request->validate([
            'title' => 'required|string|min:10|max:255',
            'content' => 'required|string|min:100',
        ]);

        // Create the blog post and associate it with the authenticated user
        $post = BlogPost::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        session()->put('success', 'Blog post created successfully!');

        return redirect()->route('show', $post->id)->with('success', 'Blog post created successfully!');
    }
    public function show($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('show', compact('post'));
    }

    public function dashboard(Request $request)
    {
        $filter = $request->input('filter', 'mine');

        if ($filter == 'all') {
            $posts = BlogPost::all();
        } else {
            $posts = BlogPost::where('user_id', Auth::id())->get();
        }
        return view('dashboard', compact('posts', 'filter'));
    }
}
