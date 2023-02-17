<?php
$action_msg = "";

$requesturi = $_SERVER['REQUEST_URI'];
//$action_msg .= "REQUEST_URI = ".$requesturi."<br>\n";

$uri_arr = Array('search' => '/search', 'make' => '/edit/make', 'fix' => '/edit/fix');

    foreach($uri_arr AS $key => $val) {
        if($requesturi == $val) {
            $cssarr[$key] = 'active';
            //$action_msg .= "active key->".$key." val->".$val."<br>\n";
        }
        else {
            $cssarr[$key] = '';
            //$action_msg .= "un key->".$key." val->".$val."<br>\n";
        }
    }

    //$action_msg .= "cssarr in search->".$cssarr['search']." : make->".$cssarr['make']." : fix->".$cssarr['fix']."<br>\n";


?>
                <!-- offcanvas-left -->
                <div id="cnt_menu">
                   <div class="offcanvas-collapse-from-left side-base print-none">
                        <nav class="">
                        <div id="menu_li">
                            <!--<h3 class="side-head p-3 font-size-rg">見積システム</h3>  offcanvas_left-->
                                <ul>
                                    <li class="gc1 {{ $cssarr['search'] }}"><a class="" href="{{ url('/search') }}">検索</a></li>
                                    <li class="gc1 {{ $cssarr['make'] }}"><a class="" href="{{ url('/edit/make') }}">名刺新規作成</a></li>
                                    <li class="gc1 {{ $cssarr['fix'] }}"><a class="" href="{{ url('/edit/fix') }}">名刺修正編集</a></li>
                                </ul>
                        </div>
                        </nav>
                    </div>
                </div>
                    <!-- /offcanvas-left -->
                    {!! $action_msg !!}
