<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;
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

        DB::beginTransaction();
        try{
        $question = new Question($request->get('question',[
            'title' => $request->title,
            'contents' => $request->contents,
            'user_id' => auth()->user()->id,
        ]));

        $question->save();

        $votes = $request->all();

        foreach ($votes['vote'] as $vote) {
            foreach ($vote as $key => $value) {
                $data = [
                    'vote' => $value,
                    'question_id' => $question->id,
                ];

                $vote = Vote::insert($data);
            }
        }

    }catch(Exception $e){
        DB::rollback();
        return back()->withInput();
    }
    DB::commit();
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

       try{
        Question::destroy($id);
        } catch(\Throwable $e){
            abort(500);
        }
        \Session::flash('err_msg', '削除しました');
            return redirect(route('questions.index'));
    }
}
