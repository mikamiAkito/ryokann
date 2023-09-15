<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Bookings;
use App\Posts;
use App\Like;

class LikeController extends Controller
{
    public function index(Request $request)
    {
        $like = new Like;
        $user = new User;
        $user_id = Auth::user()->id;

        $likeall = $like->where('user_id', $user_id)->get();
        // dd($likeall);

        $list = DB::table('posts')
        ->select('posts.image', 'posts.image2', 'posts.image3', 'posts.title', 'posts.amount', 'posts.explanation', 'posts.date_strat', 'posts.date_end', 'likes.user_id','likes.posts_id')
        ->join('likes', 'posts.id', '=', 'likes.posts_id')
        ->get();

        $likesindexlist = $list->where('user_id', $user_id);
        // dd($likesindexlist);


        return view('likes.list', [
            'likes' => $likesindexlist,
        ]);
    }
}
