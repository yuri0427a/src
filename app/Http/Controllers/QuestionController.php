<?php

namespace App\Http\Controllers;
use App\Models\Question;
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
        Question::create([
            'user_id' => auth()->user()->id,
        ]);
        \Session::flash('success', 'ブログを投稿しました');

        return redirect(route('questions.index'));
    }

    public function index()
    {
        $questions = Question::all();

        return view('questions.index', compact('questions'));
    }


}
