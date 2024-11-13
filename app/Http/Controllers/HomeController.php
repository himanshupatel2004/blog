<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        // $user = DB::table('users')->join('cities', 'cities.id', 'users.city_id')->where('users.id', Auth::id())->select('users.*','cities.name')->first();
        if (!$user) {
            return redirect('/');
        }
        return view('home', compact('user'));
    }

    
    public function relationships()
    {
        $user = Auth::user();
        $city = $user->city;       // One-to-One Relationship

        $users = $city->users;   // One-to-Many Relationship
        dd($users->toArray());

    }

}