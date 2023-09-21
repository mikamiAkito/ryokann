<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequestName;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Like;
use App\Violation;
use App\Bookings;
use App\Posts;
use App\User;

class SearchController extends Controller
{
    public function search(SearchRequestName $request)//検索機能
    {

        $like_model = new Like;

        $keyword = $request->input('keyword');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $minAmount = $request->input('minAmount');
        $maxAmount = $request->input('maxAmount');

        // dd($request->all());

        $query = Posts::query();
        
        //曖昧検索
        if(!empty($keyword)) {//$keywordが空ではない場合、検索処理を実行します
            $query->where(function($queryBuilder) use ($keyword) {//*デフォルトで金額が5000～5000になっているので注意
                $queryBuilder->where('title', 'LIKE', "%{$keyword}%")
                            ->orWhere('explanation', 'LIKE', "%{$keyword}%");
            });
        }

        //日付範囲検索
        if (!empty($minPrice)) {
            $query->where('date_strat', '>=', $minPrice);
        }
    
        if (!empty($maxPrice)) {
            $query->where('date_strat', '<=', $maxPrice);
        }

        if (!empty($minPrice)) {
            $query->where('date_end', '>=', $minPrice);
        }
    
        if (!empty($maxPrice)) {
            $query->where('date_end', '<=', $maxPrice);
        }

        //金額範囲検索
        if (!empty($minAmount)) {
            $query->where('amount', '>=', $minAmount);
        }
    
        if (!empty($maxAmount)) {
            $query->where('amount', '<=', $maxAmount);
        }
    
        $posts = $query->get();

        // dd($posts);
        
        return view('posts.list')->with(['posts' => $posts, 'like_model' => $like_model]);
    }
}