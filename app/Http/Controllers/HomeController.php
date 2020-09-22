<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->is_author) {
            return view('authorHome');
        }else{
            $posts = Post::paginate(3);
            return view('home',[
                'posts' => $posts
            ]);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function authorHome()
    {

        $live_posts = Post::where('author_id', Auth::user()->id)->count();
        $trashed_post = Post::onlyTrashed()->where('author_id', Auth::user()->id)->count();
        $all_post_count = $live_posts + $trashed_post;
        return view('authorHome', [
            'live_post' => $live_posts,
            'trashed_post' => $trashed_post,
            'all_post_count' => $all_post_count
        ]);
    }
}
