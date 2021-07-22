<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Menuitem;
use App\Models\Section;
use ehwas\documents\DocShow;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    protected $section;
    protected $user;

    public function handle(Request $request)
    {
        $this->unser = $user = $request->session()->get('user');
        $menu = $this->getMainMenu();
        $mtree = $menu['_tree_'];

        unset($menu['_tree_']);

        return view('cms.desktop', compact(['user', 'menu']));
    }

    public function handleMenuRequest(Request $request)
    {
        $params = $request->only([
            'access_group',
            'node',
            'level',
            'parent'
        ]);

        $submenu = Menuitem::subMenu($params);

        return response()->json($submenu);
    }

    public function handleSection(Request $request, $section_name)
    {
        $section = Section::valid(true)->sectionByName($section_name)->get();

        if ($section->count()) {
            $this->section = $section->map(function ($item, $ley) {
                return collect($item)->except([
                    'off',
                    'created_at',
                    'updated_at'
                ]);
            })->first();

            $this->user = $request->session()->get('user');

            return $this->render();
        } else {
            return redirect()->route('cms.root')->with('error', @trans('cms.errors.no_section'));
        }
    }

    protected function retrieveSectionContents()
    {
        $docShow = new DocShow();
        $contents = $docShow->retrieveContents($this->section->get('template'));
        $docShow->__destruct();
        unset($docShow);

        return $contents;
    }

    protected function getMainMenu()
    {
        return Menuitem::mainCMS(1);
    }

    protected function render()
    {
        $user = $this->user;
        $menu = $this->getMainMenu();
        $mtree = $menu['_tree_'];

        unset($menu['_tree_']);

        /* Section settings retrieving */
        $view = $this->section->get('gen_view');
        $contents = $this->retrieveSectionContents();

        return view($this->section->get('entry_point'), compact([
            'view',
            'menu',
            'mtree',
            'contents',
            'user'
        ]));

    }

}
