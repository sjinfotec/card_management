@extends('layouts.main')

@section('content')
<div id="home_cnt">
					<!-- Edit.blade main contentns row -->
					<div id="app">
							<Edit
auth-name='{{ Auth::user()->name }}'
auth-companycode='{{ Auth::user()->company_code }}'
auths='{{ Auth::user() }}'
								html-select='{{ $htmlselect }}'
								select-mode='{{ $select_mode }}'
								v-bind:authusers="{{ $authusers }}"
							>
							</Edit>
					</div>
					<!-- /Edit.blade main contentns row -->
					
@endsection

<?php

// auth-name='{{ Auth::user()->name }}'
// auth-companycode='{{ Auth::user()->company_code }}'
// auths='{{ Auth::user() }}'


?>
