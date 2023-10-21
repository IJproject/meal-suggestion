<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        if(!is_null($request->user)){
            dd($request);
        };
        // サーチ機能つけたいね
        $blogs = Blog::with('user')->get();
        return Inertia::render('Blog/Index', [
            'blogs' => $blogs,
        ]);
    }

    public function create()
    {

    }

    public function show(Blog $blog)
    {
        dd($blog);
    }

    public function edit(Blog $blog)
    {

    }

    public function store(Blog $blog)
    {

    }

    public function update(Blog $blog)
    {

    }
}
