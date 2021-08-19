@extends('layouts.app')

@section('content')
管理者/ユーザー詳細
        {{ $user->id }}
        {{ $user->name }}
        {{ $user->email }}
        {{ $user->introduction }}
        {{ $user->created_at }}
        {{ $user->updated_at }}
        <a href="{{ route('admin.users.edit', $user->id) }}" ><button class='btn btn-info'>編集</button></a>
        @foreach ($questions as $question)
            <a href="{{ route('questions.show', $question->id)}}">
                {{ $question->title }}
            </a>
        @endforeach
@endsection
