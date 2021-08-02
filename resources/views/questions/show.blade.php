@extends('layouts.app')

@section('content')
お題詳細
        {{ $question->id }}
        {{ $question->title }}
        {{ $question->contents }}
        {{ $question->user->name }}
 @endsection
