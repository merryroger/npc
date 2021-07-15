<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function handle(Request $request)
    {
        $user = $request->session()->get('user');

        return view('cms.desktop', compact(['user']));
    }
}
