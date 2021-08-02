@extends('layouts.app')

@section('content')

 <form action="{{ route('questions.destroy', $question->id)}}" method="post" class="float-right">
    @csrf
    @method('delete')
        <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
 </form>
お題詳細
        {{ $question->id }}
        {{ $question->title }}
        {{ $question->contents }}
        {{ $question->user->name }}
 @endsection
