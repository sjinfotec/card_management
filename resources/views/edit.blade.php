@extends('layouts.main')

@section('content')
<div id="home_cnt">
					<!-- Edit.blade main contentns row -->
					<div id="app">
							<Edit
								html-select='{{ $htmlselect }}'
								select-mode='{{ $select_mode }}'
							>
							</Edit>
					</div>
					<!-- /Edit.blade main contentns row -->


					
@endsection
