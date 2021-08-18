@extends('layouts.admin.app')

@section('content')
お題一覧
@foreach ($questions as $question)

<a href="{{ route('questions.show', $question->id)}}">
        {{ $question ->id }}
        {{ $question->title }}
        {{ $question->contents }}
</a>
<form action="{{ route('admin.questions.destroy', $question->id)}}" method="post" class="float-right">
    @csrf
    @method('delete')
        <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
 </form>
 @endforeach
 @endsection
