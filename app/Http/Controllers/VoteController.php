<?php

namespace App\Http\Controllers;
use App\Models\Vote;
use App\Models\Question;

use Illuminate\Http\Request;

class VoteController extends Controller
{

    // 投票結果をデータベースに保存
    public function vote(Request $request){
        $favorite = Vote::where('vote', $request->vote)->first();
        $favorite -> number++;
        $favorite->update();

        return back();
    }

}
