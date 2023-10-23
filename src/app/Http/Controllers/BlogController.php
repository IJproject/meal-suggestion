<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Blog;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->currentUser = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $search = (object)[];
        $blogs = $this->searchBlog($request, $search);
        
        return Inertia::render('Blog/Index', [
            'blogs' => $blogs,
            'search' => $search,
        ]);
    }

    private function searchBlog($request, &$search)
    {
        $search->title = $request->title;
        $search->userName = $request->userName;

        if(!is_null($request->user) && !is_null($request->title)){
            $blogs = Blog::where('title', 'LIKE', "%{$search->title}%")->with('user')->get();
        } else if(!is_null($request->user)) {
            $blogs = Blog::with('user')->get();
        } else if(!is_null($request->title)) {
            $blogs = Blog::where('title', 'LIKE', "%{$request->title}%")->with('user')->get();
        } else {
            $blogs = Blog::with('user')->get();
        }
        return $blogs;
    }

    public function create()
    {
        return Inertia::render('Blog/Create');
    }

    public function show(Blog $blog)
    {
        // 編集と削除の権限あればTrue、なければFalse
        $hasAccessRight = true;
        if($blog->user_id !== $this->currentUser->id){
            $hasAccessRight = false;
        }

        $blog->load('user');

        return Inertia::render('Blog/Show', [
            'blog' => $blog,
            'hasAccessRight' => $hasAccessRight,
        ]);
    }

    public function edit(Blog $blog)
    {
        if($blog->user_id !== $this->currentUser->id){
            abort(404);
        };
        return Inertia::render('Blog/Edit', [
            'blog' => $blog,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $blog = new Blog();
        $blog->user_id = $this->currentUser->id;
        $blog->fill($request->only(['title', 'content']))->save();

        $blogs = Blog::with('user')->get();
        return Inertia::render('Blog/Index', [
            'blogs' => $blogs,
        ]);
    }

    public function update(Request $request, Blog $blog)
    {
        if($blog->user_id !== $this->currentUser->id){
            abort(404);
        };

        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $blog->fill($request->only(['title', 'content']))->save();

        $blog->load('user');

        return Inertia::render('Blog/Show', [
            'blog' => $blog,
            'hasAccessRight' => true,
        ]);
    }

    public function destroy(Blog $blog)
    {
        
        if($blog->user_id !== $this->currentUser->id){
            abort(404);
        }

        $blog->delete();

        $blogs = Blog::with('user')->get();
        return Inertia::render('Blog/Index', [
            'blogs' => $blogs,
        ]);
    }
}
