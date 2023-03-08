<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DbCommon extends Model
{
    use HasFactory;

    private $scode;
    public function getDBname() {

        if($get_code = Auth::user()->code ?  : '') {
        	$scode = "mysql_".$get_code;	// databese.phpの記述に合わせる
            $config = \Config::get('database.connections');
            if( !isset($config[$scode]) ) {
                $scode = 'mysql';
            } 
        }
        return $scode;
    }

    public function getDBnameSubdomain() {
        $host_name = request()->getHost();
        $subdomain = explode('.', $host_name)[0];

        if($get_code = $subdomain ? : '') {
        	$scode = "mysql_".$get_code;	// databese.phpの記述に合わせる
            $config = \Config::get('database.connections');
            if( !isset($config[$scode]) ) {
                $scode = 'mysql';
            } 
        }
        return $scode;
    }

}

