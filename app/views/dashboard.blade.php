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
    @if($recent_fcasts->count() > 0)
        <table cellpadding="0" cellspacing="0" border="0" id="recent_fcasts" class="table table-striped table-bordered sortable">
        	<thead>
    			<tr role="row">
                    <th>Date</th>
    				<th>Question</th>
    			</tr>
    		</thead>
        @foreach($recent_fcasts as $fcast)
        	<tr>
                <td>{{$fcast->created_at}}</td>
        		<td><a href="/questions/{{$fcast->ifp_id}}">{{$fcast->ifp_id}}: {{Ifp::find($fcast->ifp_id)->short_title}}</a></td>
        	</tr>
        @endforeach
        </table>
    @else
        You have not made any forecasts yet.
    @endif
@stop