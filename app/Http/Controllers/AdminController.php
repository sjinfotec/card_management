<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminController extends Controller
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


    public function pwmake(Request $request)
    {
        $authusers = Auth::user();
        $result['htmlselect'] = "NEWSSS";
        $result['password'] = $request->password;
        $htmlselect = "NEWNEW";
        $select_mode = "NEW";
        return view('admin', compact(
            'authusers',
            'result',
            'htmlselect',
            'select_mode'
            )
        );
    }


    public function fix(Request $request)
    {
        $authusers = Auth::user();
        $result['htmlselect'] = "NEWSSS";
        $htmlselect = "NEWNEW";
        $select_mode = "EDT";
        return view('edit', compact(
            'authusers',
            'result',
            'htmlselect',
            'select_mode'
            )
        );
    }


}
