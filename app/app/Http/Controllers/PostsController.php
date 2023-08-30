<?php

namespace App\Http\Controllers;

use App\Likes;
use App\Posts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::withCount('likes')->orderBy('created_at', 'desc')->paginate(10);
        $param = [
            'posts' => $posts,
        ];
        return view('posts.list', $param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.createposts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $posts = new Posts;
        $posts->user_id = $request->user()->id;
        $posts->title = $request->title;
        $posts->date = $request->date;
        $posts->amount = $request->amount;
        $posts->explanation = $request->explanation;

        $filePath = $request->image->store('public');
        $posts->image = str_replace('public/', '', $filePath);
        $filePath2 = $request->image2->store('public');
        $posts->image2 = str_replace('public/', '', $filePath2);
        $filePath3 = $request->image3->store('public');
        $posts->image3 = str_replace('public/', '', $filePath3);

        $posts->save();

        return redirect("/posts");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Posts::find($id);
        return view('posts.detail')->with(['posts' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Posts::find($id);
        return view('posts.edit')->with(['posts' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $posts = Posts::find($id);
        $posts->title = $request->title;
        $posts->date = $request->date;
        $posts->image = $request->image;
        $posts->image2 = $request->image2;
        $posts->image3 = $request->image3;
        $posts->save();

        return view('posts.detail')->with(['posts' => $posts]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $posts, $id)
    {
        $posts = Posts::find($id);
        $posts->delete();
        return redirect(route('posts.index'))->with('success', '削除しました');
    }

    public function like(Request $request)
    {
        $user_id = Auth::user()->id; 
        $post_id = $request->post_id; 
        $already_liked = Likes::where('user_id', $user_id)->where('post_id', $post_id)->first(); //3.
    
        if (!$already_liked) { 
            $like = new Likes; 
            $like->post_id = $post_id; 
            $like->user_id = $user_id;
            $like->save();
        } else {
            Likes::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }

        $post_likes_count = Posts::withCount('likes')->findOrFail($post_id)->likes_count;
        $param = [
            'post_likes_count' => $post_likes_count,
        ];
        return response()->json($param); 
    }
    
}
