@extends('layouts.main')

@section('content')
<div id="home_cnt">
					<!-- Edit.blade main contentns row -->
					<div id="app">
						<div>laravel変数 $result['htmlselect'] : {{ $result['htmlselect'] }}</div>
						<div>laravel変数 htmlselect : {{ $htmlselect }}</div>
						<div>laravel変数 selectmode : {{ $select_mode }}</div>
							<Edit
								html-select='{{ $htmlselect }}'
								select-mode='{{ $select_mode }}'
							>
							</Edit>
					</div>
					<!-- /Edit.blade main contentns row -->
					
@endsection
