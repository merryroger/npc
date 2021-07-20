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
        $menu = $this->getMainMenu();
        $mtree = $menu['_tree_'];

        unset($menu['_tree_']);

        return view('cms.desktop', compact(['user', 'menu']));
    }

    protected function getMainMenu() {
        return Menuitem::mainCMS(1);
    }

}
