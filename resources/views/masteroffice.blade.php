@extends('layouts.main')

@section('content')
<div id="home_cnt">
					<!-- Edit.blade main contentns row -->
					<div id="app">
							<master-office
								html-select='{{ $htmlselect }}'
								select-mode='{{ $select_mode }}'
							>
							</master-office>
					</div>
					<!-- /Edit.blade main contentns row -->


					
@endsection
