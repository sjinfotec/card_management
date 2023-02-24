@extends('layouts.main')

@section('content')
<div id="home_cnt">
	@php

$password = '1234';
$hash_Password = bcrypt($password);
echo $hash_Password."<br>\n";

$password = '1234';
$hash = password_hash($password, PASSWORD_DEFAULT);
if(password_verify($password, $hash)){
	echo "OK.<br>\n";
	echo $hash."<br>\n";
}else{
	echo "NG.";
}

	@endphp



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
