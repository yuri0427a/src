@extends('layouts.admin.app')

@section('content')
管理者/ユーザー一覧
@foreach ($users as $user)
        {{ $user ->id }}
        {{ $user->name }}
        {{ $user->email }}
<form action="{{ route('admin.users.destroy', $user->id)}}" method="post" class="float-right">
    @csrf
    @method('delete')
        <input type="submit" value="強制退会" class="btn btn-danger" onclick='return confirm("会員番号:{{ $user->id }}　{{ $user->name }}を強制退会させますか？");'>
 </form>
@endforeach
@endsection
