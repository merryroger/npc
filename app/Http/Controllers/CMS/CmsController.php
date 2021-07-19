<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Menuitem;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function handle(Request $request)
    {
        $user = $request->session()->get('user');
        $menu_collection = Menuitem::validItems()->accessgroup(1)->byLevel(0)->get();

        return view('cms.desktop', compact(['user', 'menu_collection']));
    }
}
