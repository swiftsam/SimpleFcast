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
<div class="col-lg-2">
	<div class="input-group">
		<input type="text" class="form-control">
		<span class="input-group-btn"></span>
	</div>
</div>

@stop