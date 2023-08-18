<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisplayController extends Controller//DBからのデータ取得などを管理
{
    public function index() {
        return view('posts');
    }
}
