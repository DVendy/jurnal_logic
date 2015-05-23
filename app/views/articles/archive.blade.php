@extends('layout.master')

@section('head')
	@parent
	<title>
		Jurnal Logic | Archive
	</title>
@stop

@section('content')
	<div class="well well_custom">
		<h1><b>Journal Archive</b></h1>
		Please select an issue below to view its contents.
		<table class="table table-striped" id="tab_archive">
			<tbody>
			<thead>
				<tr>
				<th>Volume</th>
				<th>Issue</th>
				</tr>
			</thead>
				@foreach($arr_vol as $key)	
					<tr>
						<td class="col-md-3">
							<b>Volume {{ $key }}</b>
						</td>
						<?php
							$dumb = $issue->filter(function($item) use ($arr_vol, $key) {
							    return $item->volume == $key;
							});
						?>
						@foreach ($dumb as $key2)
						    <td class="col-md-2">
						    	<a href="{{ URL::route('archive-show', $key2->id) }}">{{ $key2->month }}</a>
						    </td>
						@endforeach
						
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop