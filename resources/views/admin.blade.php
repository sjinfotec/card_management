@extends('layouts.main')

@section('content')
<div id="home_cnt">

@php

$pwsend_result = false;
if(isset($result['password'])) {
	echo $result['password']."<br>\n";
	$password = $result['password'];
	$pwsend_result = true;
}
else {
	echo "ハッシュ値（パスワード）が送信されていません<br>\n";
	$password = '1234';
}

//$hash_Password = bcrypt($password);
//echo $hash_Password."<br>\n";

$hash = password_hash($password, PASSWORD_DEFAULT);
if(password_verify($password, $hash)){
	if($pwsend_result) {
		echo "OK.<br>\n";
	}
	else {
		echo "デフォルトのハッシュ値で処理します<br>\n";
	}
	//echo $hash."<br>\n";
	echo "<input type='text' id='copyTarget' class='form_style input_w40' value='".$hash."' readonly='readonly'>\n";
	echo "<button onclick='copyToClipboard()'>Copy text</button>\n";
}else{
	echo "NG.";
}

@endphp

<div class="mgt20">ハッシュ値を作成します</div>
<form action="" method="post">
	<input type="text" class="form_style" name="password">
	<input type="submit" class="" value="作成">
	@csrf
</form>

					<div>
					<!--result['password'] = {{ $result['password'] }}-->
					</div>
<!--
					<div id="app">
							<Edit
								html-select='{{ $htmlselect }}'
								select-mode='{{ $select_mode }}'
								v-bind:authusers="{{ $authusers }}"
							>
							</Edit>
					</div>
-->

	<script>
        function copyToClipboard() {
            // コピー対象をJavaScript上で変数として定義する
            var copyTarget = document.getElementById("copyTarget");

            // コピー対象のテキストを選択する
            copyTarget.select();

            // 選択しているテキストをクリップボードにコピーする
            document.execCommand("Copy");

            // コピーをお知らせする
            alert("コピーできました！ : " + copyTarget.value);
        }
    </script>


@endsection
