<?php

namespace App\Http\Controllers;

use App\Posts;
use App\Like;
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

        $data = [];
        $posts = new Posts;
        $posts = Posts::withCount('likes')->orderBy('created_at', 'desc')->paginate(10);
        $like_model = new Like;

        $data = [
                'posts' => $posts,
                'like_model'=>$like_model,
            ];

        return view('posts.list', $data);
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

    public function ajaxlike(Request $request)
    {
        $id = Auth::user()->id;
        $posts_id = $request->posts_id;
        $like = new Like;
        $posts = Posts::findOrFail($posts_id);

        if ($like->like_exist($id, $posts_id)) {
            $like = Like::where('posts_id', $posts_id)->where('user_id', $id)->delete();
        } else {
            $like = new Like;
            $like->posts_id = $request->posts_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }

        $postsLikesCount = $posts->loadCount('likes')->likes_count;

        $json = [
            'postsLikesCount' => $postsLikesCount,
        ];
        return response()->json($json);
    }
}
