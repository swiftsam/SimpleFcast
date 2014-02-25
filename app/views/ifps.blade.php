@extends('layout')

@section('content')
	<h2>Questions</h2>
	<table cellpadding="0" cellspacing="0" border="0" id="questions" class="table table-striped table-bordered sortable">
		<thead>
			<tr role="row">
				<th>ID</th>
				<th>Short Question Title</th>
				<th>Status</th>
				<th>Launch Date</th>
				<th>Scheduled Close</th>
			</tr>
		</thead>
		<tbody>
  		@foreach($ifps as $ifp)
        	<tr>
        		<td>{{ $ifp->id }}</td>
        		<td><a href="questions/{{$ifp->id}}">{{$ifp->short_title}}</a></td>
        		<td class="{{$ifp->css_class()}}">{{ $ifp->status_verbal() }}</td>
        		<td>{{ $ifp->date_start }}</td>
        		<td>{{ $ifp->date_to_end }}</td>
        	</tr>
    	@endforeach
    	</tbody>
	</table>
@stop
