@extends('layout')

@section('content')
    <h2>Newest Questions</h2>
	@foreach($ifps_newest as $ifp)
    	<div class="ifp_thumb">
    		<a href="questions/{{$ifp->id}}">
    			<img class="media-object" src="/img/ifp/{{$ifp->id}}.jpg" alt="">
    			{{$ifp->id}}: {{$ifp->short_title}}
    		</a>
    	</div>
    @endforeach

    <br style="clear:left;">
    <h2>Recently Closed Questions</h2>
	@foreach($ifps_closed as $ifp)
    	<div class="ifp_thumb">
    		<a href="questions/{{$ifp->id}}">
    			<img class="media-object" src="/img/ifp/{{$ifp->id}}.jpg" alt="">
    			{{$ifp->id}}: {{$ifp->short_title}}
    		</a>
    	</div>
    @endforeach

    <br style="clear:left;">
    <h2>Your Recent Forecasts</h2>
    <table cellpadding="0" cellspacing="0" border="0" id="recent_fcasts" class="table table-striped table-bordered sortable">
    	<thead>
			<tr role="row">
				<th>Question</th>
				<th>Date</th>
			</tr>
		</thead>
    @foreach($recent_fcasts as $fcast)
    	<tr>
    		<td><a href="/questions/{{$fcast->ifp_id}}">{{$fcast->ifp_id}}: {{Ifp::find($fcast->ifp_id)->short_title}}</a></td>
    		<td>{{$fcast->created_at}}</td>
    	</tr>
    @endforeach
    </table>
@stop