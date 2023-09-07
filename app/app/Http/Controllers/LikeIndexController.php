<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Like;
use App\User;
use App\Bookings;


class LikeIndexController extends Controller
{
    public function index(Request $request)
    {
        $like = new Like;
        $user = new User;
        $user_id = Auth::user()->id;

        $likeall = $like->where('user_id', $user_id)->get();

        $list = DB::table('posts')
            ->select('posts.image', 'posts.image2', 'posts.image3', 'posts.explanation', 'posts.amount', 'posts.title', 'posts.date', 'likes.user_id','likes.post_id')
            ->join('llikes', 'post.id', '=', 'likes.post_id')
            ->get();

        $likesindexlist = $list->where('user_id', $user_id);

        dd($list);
    }
}
