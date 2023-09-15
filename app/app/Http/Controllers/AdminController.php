<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Violation;
use App\Bookings;
use App\Posts;
use App\User;
use DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $posts = Posts::find($id);

        $colums = ['del_flg'];

        foreach($colums as $colum)
        {
            $posts->$colum = $request->$colum;
        }
        
        $posts->save();

        $posts = Posts::withCount('violations')->orderBy('violations_count', 'desc')->limit(20)->get();//違反報告数の上位20件を取得

        // dd($posts);

        return view('admins.posts')->with(['posts' => $posts]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return view('posts.list');
    }

    public function users()
    {

        $users = User::withCount(['posts' => function (Builder $users) {
            $users->where('del_flg', '1');
        }])->orderBy('posts_count', 'desc')->limit(10)->get();//違反報告数の上位10件を取得
        // dd($users);

        return view('admins.users')->with(['users' => $users]);
    }

    public function posts()
    {
        // $posts = \DB::table('violations')->distinct()->select('post_id')->get();
        // dd($posts);
        
        $posts = Posts::withCount('violations')->orderBy('violations_count', 'desc')->limit(20)->get();//違反報告数の上位20件を取得
        // dd($posts);
        return view('admins.posts')->with(['posts' => $posts]);
    }
}
