<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('category', 'user')->latest();

        // Filter by category
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('id', $request->category);
            });
        }

        // Search by title
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $posts = $query->paginate(10); // Changed from 5 to 10 posts per page
        $categories = Category::all();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show($id)
    {
        $post = Post::find($id);
        
        if (!$post) {
            return response()
                ->view('blog.not-found', [], 404);
        }

        return view('blog.show', compact('post'));
    }
}
