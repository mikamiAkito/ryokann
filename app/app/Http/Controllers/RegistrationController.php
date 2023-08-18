<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller//データの登録や編集を管理
{
    public function createPosts(Request $request) {
        echo $request;
    }

    public function createPostsForm() {
        return view('create_posts');
    }
}
