@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
管理者/ユーザー編集
<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="form-group">
          <label for="subject">
            ユーザー名
          </label>
          <input type="text" name="name" value="{{ $user->name }}"class="form-control">
        </div>
        <div class="form-group">
            <label for="subject">
                メールアドレス
            </label>
            <input id="name" type="text" name="email" value="{{ $user->email }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="subject">
              自己紹介
            </label>
            <input id="name" type="text" name="introduction" value="{{ $user->introduction }}" class="form-control">
        </div>
        <a class="btn btn-secondary" href="{{ route('admin.users.show', $user->id) }}">
            キャンセル
        </a>
        <button type="submit" class="btn btn-primary">
            更新する
        </button>
</form>
@endsection
