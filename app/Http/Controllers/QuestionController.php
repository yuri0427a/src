<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Vote;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
class QuestionController extends Controller
{
    public function create()
    {
        return view('questions.create');
    }

    public function store(QuestionRequest $request)
    {
        $question = Question::create([
            'title' => $request->title,
            'contents' => $request->contents,
            'user_id' => auth()->user()->id,
        ]);
        \Session::flash('success', 'お題を投稿しました');

        return redirect(route('questions.index'));
    }

    public function index()
    {
        $questions = Question::all();

        return view('questions.index', compact('questions'));
    }


    public function show($id)
    {
        $question = Question::find($id);
        $votes= $question->vote;

        return view('questions.show', compact('question', 'votes'));
    }

    public function destroy($id){

       if(empty($id)){
        \Session::flash('err_msg', 'データがありません');
        return redirect(route('questions.show'));
       }

       try{
        Question::destroy($id);
        } catch(\Throwable $e){
            abort(500);
        }
        \Session::flash('err_msg', '削除しました');
            return redirect(route('questions.index'));
    }
}
