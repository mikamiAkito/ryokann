<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Violation;
use App\Bookings;
use App\Posts;
use App\User;

class ViolationController extends Controller
{
    public function index(Request $request)
    {
        $post_id = $request['post_id'];
        //dd($post_id);
        return view('violations.create')->with(['posts' => $post_id]);
    }

    public function create(Request $request)
    {
        $violations = new Violation;
        $violations->reason = $request->reason;
        $violations->user_id = $request->user()->id;
        $violations->post_id = $request->post_id;
        $violations->save();

        return view('violations.detail');
    }
}
