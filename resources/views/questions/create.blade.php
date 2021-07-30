@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('questions.store', ) }}">
    @csrf
        <div class="form-group">
          <label for="title">
                タイトル
          </label>
          <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="subject">
                内容
            </label>
            <textarea id="name" type="textarea" name="contents" class="form-control"></textarea>
        </div>
        <a class="btn btn-secondary" href="{{ route('questions.index') }}">
            キャンセル
        </a>
        <button type="submit" class="btn btn-primary">
           投稿する
        </button>
</form>
@endsection
