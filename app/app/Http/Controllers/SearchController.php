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

        // // 範囲の開始日と終了日を指定
        // $rangeStartDate = $minPrice;
        // $rangeEndDate = $maxPrice;

        // // Carbonオブジェクトに変換
        // $rangeStartDate = Carbon::parse($rangeStartDate);
        // $rangeEndDate = Carbon::parse($rangeEndDate);

        // // 予約を取得
        // $posts = Posts::where(function ($query) use ($rangeStartDate, $rangeEndDate) {
        //     $query->where(function ($query) use ($rangeStartDate, $rangeEndDate) {
        //         // 開始日が範囲内にあるかをチェック
        //         $query->where('date_strat', '>=', $rangeStartDate)
        //             ->where('date_strat', '<=', $rangeEndDate);
        //     })->orWhere(function ($query) use ($rangeStartDate, $rangeEndDate) {
        //         // 終了日が範囲内にあるかをチェック
        //         $query->where('date_end', '>=', $rangeStartDate)
        //             ->where('date_end', '<=', $rangeEndDate);
        //     });
        // })->get();


        //日付範囲検索
        if ($minPrice !== null) {
            $query->where('date_strat', '>=', $minPrice);
        }
    
        if ($maxPrice !== null) {
            $query->where('date_strat', '<=', $maxPrice);
        }

        if ($minPrice !== null) {
            $query->where('date_end', '>=', $minPrice);
        }
    
        if ($maxPrice !== null) {
            $query->where('date_end', '<=', $maxPrice);
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
        
        return view('posts.list')->with(['posts' => $posts, 'like_model' => $like_model]);
    }
}