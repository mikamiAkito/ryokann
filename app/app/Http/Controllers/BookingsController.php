<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookingsRequest;
use App\Bookings;
use App\Posts;
use App\User;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bookings = new Bookings;
        $user = new User;
        $user_id = Auth::user()->id;

        $bookingall = $bookings->where('user_id', $user_id)->get();
        //dd($bookingall);

        $list = DB::table('posts')
        ->select('posts.image', 'posts.image2', 'posts.image3', 'posts.title', 'posts.amount', 'posts.explanation', 'posts.date', 'bookings.user_id','bookings.post_id', 'bookings.number_people', 'bookings.date_strat', 'bookings.date_end', 'bookings.id')
        ->join('bookings', 'posts.id', '=', 'bookings.post_id')
        ->get();

        $bookingsindexlist = $list->where('user_id', $user_id);
        // dd($bookingsindexlist);


        return view('bookings.list', [
            'bookings' => $bookingsindexlist,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $posts = $request['post_id'];
        return view('bookings.create')->with(['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingsRequest $request)
    {//予約システム
        
        \App\Bookings::create([
            'post_id' => $request->post_id,
            'number_people' => $request->number_people,
            'user_id' => $request->user()->id,
            'date_strat' => $request->date_strat,
            'date_end' => $request->date_end,
        ]);


        return back()->with('result', '予約が完了しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bookings  $bookings
     * @return \Illuminate\Http\Response
     */
    public function show(Bookings $bookings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bookings  $bookings
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bookings = Bookings::find($id);
        return view('bookings.edit')->with(['bookings' => $bookings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bookings  $bookings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bookings = Bookings::find($id);
        $bookings->number_people = $request->number_people;
        $bookings->date_strat = $request->date_strat;
        $bookings->date_end = $request->date_end;
        $bookings->save();

        return view('users.detail');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bookings  $bookings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookings $bookings, $id)
    {
        $bookings = Bookings::find($id);
        $bookings->delete();
        return redirect(route('bookings.index'))->with('success', '削除しました');
    }
}
