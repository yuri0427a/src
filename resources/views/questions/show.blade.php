@extends('layouts.app')

@section('content')

 <form action="{{ route('questions.destroy', $question->id)}}" method="post" class="float-right">
    @csrf
    @method('delete')
        <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
 </form>
お題詳細
        {{ $question->id }}
        {{ $question->contents }}
        {{ $question->user->name }}

	<form method="post" action="{{ route('votes.vote')}}">
		@csrf
		@method('put')
        @foreach ($votes as $vote)
            <div class="form-check">
                <input name="vote_id" value="{{ $vote->id }}" type="radio">
                <input name="vote" value="{{ $vote->vote }}" type="hidden">
                <input name="question_id" value="{{ $vote->question_id }}" type="hidden">
                <label class="form-check-label" for="{{ $vote->vote }}">{{ $vote->vote }}</label>
            </div>
　　　　　@endforeach
         <button type=”submit” class="btn btn-danger btn-primary">投票する</button>
	</form>
        <!-- 投票のグラフ表示 -->
        <div id="chart" style="height:500px;width:800px;"></div>

        <script>
            google.charts.load('current', {packages: ['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart(){

                var data=google.visualization.arrayToDataTable([
                ['vote', 'number'],
                <?php
                    foreach($votes  as $vote){
                        echo "['".$vote->vote."', ".$vote->number."],";
                    }
                ?>
                ]);

                var options ={
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('chart'));

                chart.draw(data, options);
            }
        </script>
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group">
            <input type="text" name="message" value="{{ old('$question->comment->message') }}" class="form-control">
            <input type="hidden" name="question_id" value="{{ $question->id }}">
        </div>
        <button type="submit" class="btn btn-primary">
           投稿する
        </button>
        </form>
        @foreach ($comments as $comment)
            {{ $comment->id }}
            {{ $comment->user->name }}
            {{ $comment->message }}
            <form action="{{ route('comments.destroy', $comment->id)}}" method="post" class="float-right">
        @csrf
        @method('delete')
        <input type="hidden" name="question_id" value="{{ $question->id }}">
        <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
 </form>
　　　　　@endforeach
z
@endsection
