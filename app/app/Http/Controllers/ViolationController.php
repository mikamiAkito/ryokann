<?php

namespace App\Http\Controllers;

use App\Http\Requests\ViolationRequest;
use Illuminate\Http\Request;
use App\Violation;
use App\Bookings;
use App\Posts;
use App\User;

class ViolationController extends Controller
{
    public function index(Request $request)
    {
        $posts_id = $request['post_id'];
        //dd($post_id);
        return view('violations.create')->with(['posts_id' => $posts_id]);
    }

    public function create(ViolationRequest $request)
    {
        $violations = new Violation;
        $violations->reason = $request->reason;
        $violations->user_id = $request->user()->id;
        $violations->posts_id = $request->posts_id;
        $violations->save();

        return view('violations.detail');
    }
}
