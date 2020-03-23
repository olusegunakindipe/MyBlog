<?php

namespace App\Http\Controllers;
use App\Post;
use App\Category;
use App\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $admin= User::where('admin', 1)->get();
        return view('admin.home')->with('posts', Post::all())
                                ->with('categories', Category::all())
                                ->with('trashed', Post::onlyTrashed())
                                ->with('users',User::all());
    }
}
