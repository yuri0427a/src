@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('questions.store') }}">
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
        <div class="form-group">
            <label for="subject">
                選択肢1
            </label>
            <input class="form-control" name="vote[0][vote]" type="text" id="vote" value="{{old('vote')}}">
        </div>
        <div class="form-group">
            <label for="subject">
                選択肢2
            </label>
            <input class="form-control" name="vote[1][vote]" type="text" id="vote" value="{{old('vote')}}">
        </div>
        <a class="btn btn-secondary" href="{{ route('questions.index') }}">
            キャンセル
        </a>
        <button type="submit" class="btn btn-primary">
           投稿する
        </button>
</form>
@endsection
