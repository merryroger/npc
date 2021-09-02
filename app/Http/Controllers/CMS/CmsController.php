<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Menuitem;
use App\Models\Section;
use ehwas\documents\collections\Collections;
use ehwas\documents\ExtDocShow;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    const ERR_UNKNOWN_ERROR = 0x00;
    const ERR_INVALID_SECTION_REQUESTED = 0x01;

    protected $section;
    protected $user;
    protected $request;
    protected $response;

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
        $this->request = $request->request->all();
        $section = Section::valid(true)->sectionByName($section_name)->get();

        if ($section->count()) {
            $this->section = $section->map(function ($item, $key) {
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

    protected function handleSectionRequest(Request $request, $section_name)
    {
        $this->response = [];
        $this->request = $request->request->all();
        $this->section = Section::valid(true)->sectionByName($section_name)->get()->map(function ($item, $key) {
            return collect($item)->except([
                'off', 'created_at', 'updated_at'
            ]);
        })->first();

        if ($this->section != null) {
            $this->response = $this->retrieveSectionContents();
        } else {
            $this->response = $this->setError($this::ERR_INVALID_SECTION_REQUESTED, 'default', [
                'section' => $section_name
            ]);
        }

        return response()->json($this->response);
    }

    protected function retrieveSectionContents()
    {
        $mode = (isset($this->request['opcode'])) ? $this->request['opcode'] : 'list';
        $out = (isset($this->request['out'])) ? $this->request['out'] : null;

        $options = collect($this->request)->except(['out', '_token'])->all();

        $docShow = new extDocShow();
        $contents = $docShow->retrieveContents($this->section->get('template'), $options, $mode, $out);
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

    public function uploadFiles(Request $request)
    {
        $collector = new Collections();
        $path = $collector->getFileUploadDir() . '/';
        $path .= ($request->has('pack_id')) ? $request->request->get('pack_id') : '';
        $fields_str = ($request->has('fields')) ? $request->request->get('fields') : '';
        $fields = ($fields_str) ? preg_split("%[\,]+%", $fields_str) : [];
        $collector->__destruct();
        unset($collector);

        for ($f = 0; $f < $request->files->count(); $f++) {
            if ($request->hasFile($fields[$f])) {
                $file = $request->file($fields[$f]);
                $file->move($path, "{$fields[$f]}." . $file->getClientOriginalExtension());
            }
        }
    }

    protected function setError($erc, $section, $options = [])
    {
        $errresp = [
            'success' => 0,
            'errorcode' => $erc,
            'section' => $section,
            'options' => $options
        ];

        return $errresp;
    }

}
