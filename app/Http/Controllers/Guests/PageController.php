<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use App\Models\Menuitem;
use App\Models\Section;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $section;

    public function getSections(Request $request, $section = 'home')
    {
        $this->section = $this->getSection($section, true);

        return $this->render();
    }

    protected function getSection($name, $include_hidden = false)
    {
        return Section::guests($include_hidden)->sectionByName($name)->first();
    }

    protected function &buildMenu()
    {
        $menu_access_group = $this->section->retrieveAccessGroup(true);
        $get_visible_items = true;

        $structure = Menuitem::structure($menu_access_group, !$get_visible_items);
        $structure['_sids_'] = Menuitem::hierarchy($menu_access_group, $get_visible_items, $this->section->id);

        return $structure;
    }

    protected function retrieveSectionContents()
    {
    //    $docShow = new DocShow();
    //    $contents = $docShow->retrieveContents($this->section->template);
    //    $docShow->__destruct();
    //    unset($docShow);
$contents = '';
        return $contents;
    }

    protected function render()
    {
        if ($this->section != null) {

            /* Menu build operations */
            $menu = $this->buildMenu();
            $menu_tree = $menu['_tree_'];
            $section_ids = $menu['_sids_'];
            unset($menu['_tree_'], $menu['_sids_']);

            $view = $this->section->view;

            /* Section content retrieving */
            $contents = $this->retrieveSectionContents();

            return view($this->section->entrypoint, compact([
                'view',
                'menu',
                'menu_tree',
                'contents',
                'section_ids'
            ]));

        }

        abort(404);
    }

}
