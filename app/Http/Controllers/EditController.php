<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\DbCommon;

class EditController extends Controller
{
    public function index(Request $request)
    {
        $authusers = Auth::user();
        return view('edit', compact('authusers'));
    }

    public function search(Request $request)
    {
        $authusers = Auth::user();
        return view('edit', compact('authusers')
        );
    }


    public function make(Request $request)
    {
        $host_name = request()->getHost();
        $subdomain = explode('.', $host_name)[0];
        echo "subdomain -> ".$subdomain."<br>\n";

        $dbcommon = new DbCommon;
        $scode = $dbcommon->getDBnameSubdomain();

        echo "scode -> ".$scode."<br>\n";

        $authusers = Auth::user();
        $result['htmlselect'] = "";
        $htmlselect = "";
        $select_mode = "NEW";
        //var_dump($authusers);

        return view('edit', [
                'authusers'=>$authusers,
                'result'=>$result,
                'htmlselect'=>$htmlselect,
                'select_mode'=>$select_mode,
            ]);
    }


    public function fix(Request $request)
    {
        $authusers = Auth::user();
        $result['htmlselect'] = "";
        $htmlselect = "";
        $select_mode = "EDT";
        //$select_mode = "fix";
        return view('edit', compact(
            'authusers',
            'result',
            'htmlselect',
            'select_mode'
            )
        );
    }


}
