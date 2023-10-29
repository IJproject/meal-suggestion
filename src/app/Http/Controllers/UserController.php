<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Services\GoogleMapsService;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->currentUser = Auth::user();
            return $next($request);
        });
    }

    public function home()
    {
        return Inertia::render('User/Home', [
            'user' => $this->currentUser,
        ]);
    }

    public function map(Request $request, GoogleMapsService $googleMapsService)
    {
        
        $existResponse = false;

        $search = (object)[];
        $isValidRequest = $request->selectedType && $request->selectedRadius && $request->latitude && $request->longitude;

        if($isValidRequest){
            // dd($googleMapsService->getCoordinatesFromAddress(''));

            $existResponse = true;

            $search->selectedType = $request->selectedType;
            $search->selectedRadius = $request->selectedRadius;
            $search->latitude = $request->latitude;
            $search->longitude = $request->longitude;
        }
        
        return Inertia::render('User/Map', [
            'user' => $this->currentUser,
            'search' => $search,
            'existResponse' => $existResponse,
        ]);
    }

    public function random()
    {
        return Inertia::render('User/Random', [
            'user' => $this->currentUser,
        ]);
    }
}
