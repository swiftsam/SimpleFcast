@extends('layout')

@section('content')
 <h2>{{$ifp->id}}: {{ $ifp->short_title }}</h2>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#question" data-toggle="tab">
		Question</a>
	</li>
	<li class="alert-{{$ifp->css_class()}}">
		<a href="#status" data-toggle="tab">Status: {{$ifp->status_verbal()}}</a>
	</li>
	<li>
		<a href="#details" data-toggle="tab">Details and Resolution Criteria</a>
	</li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<div class="tab-pane active" id="question">
		<!-- Key Image -->
		@if(file_exists(public_path("img/ifp/",$ifp->id,".jpg")))
			<div class="media pull-left">
			    <img class="media-object" src="/img/ifp/{{$ifp->id}}.jpg" alt="">
			 </div>	
		@endif
		<h4>{{$ifp->text }}</h4>
		<ul class="list-unstyled">
			@foreach($ifp->options as $opt)
				<li>{{Str::upper($opt->option)}} : {{$opt->text}}</li>
			@endforeach
		</ul>
	</div>
	<div class="tab-pane" id="status">
		<dl class="dl-horizontal">
			<dt>Launched</dt><dd>{{$ifp->date_start}}</dd>
			<dt>Scheduled Close</dt><dd>{{$ifp->date_to_end}}</dd>
			<dt>Closed</dt><dd>{{$ifp->date_end}}</dd>
		</dl>
	</div>
	<div class="tab-pane" id="details">
		{{$ifp->desc }}
	</div>
</div>

@if($ifp->status == 1)
<!-- Make a Forecast -->
<h2>Make a Forecast</h2>
{{ Form::open(array('url' => url('/fcast'), 'class' => 'form-horizontal', 'role'=>'form', 'id'=>'forecast')) }}
    {{ Form::hidden('ifp_id', $ifp->id) }}
    @foreach($ifp->options as $opt)
    	<div class="form-group">
    		<div class="col-sm-1">
    			<input type="text" class="form-control" name="opt_{{$opt->option}}" placeholder="">
    		</div>
    		<label class="col-sm-4 control-label" for="opt_{{$opt->option}}">{{$opt->text}}</label>
    	</div>
    @endforeach
	{{ Form::submit('Submit Forecast', array('class' => 'btn btn-default')) }}
{{ Form::close() }}
@endif

<!-- History of Forecasts -->
<h2>Your Forecasts</h2>
<table cellpadding="0" cellspacing="0" border="0" id="recent_fcasts" class="table table-striped table-bordered sortable">
	<thead>
		<tr role="row">
			<th>Date</th>
			@foreach($ifp->options as $option)
			<th>{{$option->text}}</th>
			@endforeach
		</tr>
	</thead>
@foreach($fcasts_ifp as $fcast)
	<tr>
		<td>{{$fcast->created_at}}</td>
		@foreach($ifp->options as $option)
		<td>{{ FcastValue::where('fcast_id','=',$fcast->id)->
						   where('ifp_option_id','=',$option->id)->
						   first()->value }}</td>
		@endforeach
	</tr>
@endforeach
</table>


@stop