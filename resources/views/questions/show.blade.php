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
                <input name="vote" value="{{ $vote->vote }}" type="radio">
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
@endsection
