<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();

        return view('admin.questions.index', compact('questions'));
    }


    public function destroy(Request $request)
    {
        try {
            $question = Question::destroy($request->id);
        }catch(\Throwable $e){
            abort(500);
        }

        return redirect()->route('admin.questions.index');
    }
}
