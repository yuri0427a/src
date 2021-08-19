@extends('layouts.app')

@section('content')
お題一覧
@foreach ($questions as $question)
<a href="{{ route('questions.show', $question->id)}}">
        {{ $question ->id }}
        {{ $question->title }}
        {{ $question->contents }}
</a>
 @endforeach
 @endsection
