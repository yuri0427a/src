@extends('layouts.app')

@section('content')
お題一覧
@foreach ($questions as $question)
        {{ $question->id }}
        {{ $question->title }}
        {{ $question->contents }}
 @endforeach
 @endsection
