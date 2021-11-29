<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use App\Models\Section;
use ehwas\documents\ExtDocShow;
use Illuminate\Http\Request;

class PageAsyncController extends Controller
{
    protected $request;
    protected $section;
    protected $user;
    protected $response;


    protected function handleRequest(Request $request, $section_name = 'home')
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
    //        $this->response = $this->setError($this::ERR_INVALID_SECTION_REQUESTED, 'default', [
    //            'section' => $section_name
    //        ]);
        }

        return response()->json($this->response);
    }

    protected function retrieveSectionContents()
    {
        $mode = (isset($this->request['opcode'])) ? $this->request['opcode'] : 'list';
        $out = (isset($this->request['out'])) ? $this->request['out'] : null;

        $options = collect($this->request)->except(['out', '_token'])->all();

        $docShow = new extDocShow();
        $contents = $docShow->retrieveContents($this->section->get('template') . '_async', $options, $mode, $out);
        $docShow->__destruct();
        unset($docShow);

        return $contents;
    }

}
