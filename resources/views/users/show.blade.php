@extends('layouts.app')

@section('content')
@if (session('success'))
            <div class="flash_message">
                {{ session('success') }}
            </div>
@endif
{{ $user->name }}
{{ $user->email }}
{{ $user->introduction }}
<a href="{{ route('users.edit', $user->id) }}" ><button class='btn btn-info'>編集</button></a>
@foreach ($questions as $question)
<a href="{{ route('questions.show', $question->id)}}">
        {{ $question->title }}
 @endforeach
@endsection
