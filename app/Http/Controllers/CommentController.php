<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();

        return view('questions.show', compact('comments'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
        $comment = new Comment($request->get('comment',[
            'message' => $request->message,
            'question_id' => $request->question_id,
            'user_id' => auth()->user()->id,
        ]));

        $comment->save();

    }catch(Exception $e){
        DB::rollback();
        return back()->withInput();
    }
        DB::commit();
        return back();
    }

    public function destroy(Request $request, $question_id)
    {
        try {
            $question =  Comment::destroy($request->id);
        }catch(\Throwable $e){
                abort(500);
            }
        \Session::flash('err_msg', '削除しました');
        return back();
    }
}
