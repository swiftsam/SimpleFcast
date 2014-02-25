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
		<ul class="list-unstyled"></ul>
			@foreach($ifp->options as $opt)
				<li>{{$opt->option}} : {{$opt->text}}</li>
			@endforeach
		</ul>
	</div>
	<div class="tab-pane" id="status">
		<p><strong>Launched</strong>: {{$ifp->date_start}}</p>
		<p><strong>Scheduled Close</strong>: {{$ifp->date_to_end}}</p>
		<p><strong>Closed</strong>: {{$ifp->date_to_end}}</p>
	</div>
	<div class="tab-pane" id="details">
		{{$ifp->desc }}
	</div>
</div>

<!-- Make a Forecast -->
<h2>Make a Forecast</h2>
<!--<form id="forecast" class="form-horizontal" role="form" action="/fcast">
	<input type="hidden" id="ifp_id" value="{{$ifp->id}}"> 
	@foreach($ifp->options as $opt)
		<div class="form-group">
	    	<div class="col-sm-1">
	    		<input type="text" class="form-control" id="{{$opt->id}}" placeholder="">
	    	</div>
	    	<label class="col-sm-3 control-label" for="opt_{{$opt->option}}">{{$opt->text}}</label>
		</div>
	@endforeach
  <button type="submit" class="btn btn-default">Submit</button>
</form>-->


{{ Form::open(array('url' => '/fcast')) }}
    {{ Form::hidden('ifp_id', $ifp->id) }}
	{{ Form::submit('Submit Forecast') }}
{{ Form::close() }}

@stop