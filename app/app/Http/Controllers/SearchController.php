<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequestName;
use Illuminate\Http\Request;
use App\Violation;
use App\Bookings;
use App\Posts;
use App\User;

class SearchController extends Controller
{
    public function search(SearchRequestName $request)//検索機能
    {
        $keyword = $request->input('keyword');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $minAmount = $request->input('minAmount');
        $maxAmount = $request->input('maxAmount');

        $query = Posts::query();
        
        //曖昧検索
        if(!empty($keyword)) {//$keywordが空ではない場合、検索処理を実行します
            $query->where(function($queryBuilder) use ($keyword) {
                $queryBuilder->where('title', 'LIKE', "%{$keyword}%")
                            ->orWhere('explanation', 'LIKE', "%{$keyword}%");
            });
        }

        //日付範囲検索
        if ($minPrice !== null) {
            $query->where('date', '>=', $minPrice);
        }
    
        if ($maxPrice !== null) {
            $query->where('date', '<=', $maxPrice);
        }

        //金額範囲検索
        if ($minAmount !== null) {
            $query->where('amount', '>=', $minAmount);
        }
    
        if ($maxAmount !== null) {
            $query->where('amount', '<=', $maxAmount);
        }
    
        $posts = $query->get();

        // dd($posts);
        
        return view('posts.list')->with(['posts' => $posts]);
    }
}