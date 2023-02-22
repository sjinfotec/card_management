<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $authusers = Auth::user();
        $result['htmlselect'] = "NEWSSS";
        $htmlselect = "NEWNEW";
        $select_mode = "NEWxx";
        return view('edit', compact(
            'authusers',
            'result',
            'htmlselect',
            'select_mode'
            )
        );
    }

}
