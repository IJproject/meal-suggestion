<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function home()
    {
        return Inertia::render('User/Home', [
            'user' => $this->user,
        ]);
    }

    public function map()
    {
        return Inertia::render('User/Map', [
            'user' => $this->user,
        ]);
    }

    public function random()
    {
        return Inertia::render('User/Random', [
            'user' => $this->user,
        ]);
    }
}
