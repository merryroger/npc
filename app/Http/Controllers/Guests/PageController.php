<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $section;

    public function getSections(Request $request, $section = 'home')
    {
        $this->section = $this->getSection($section, true);

        $this->render();
    }

    protected function getSection($name, $include_hidden = false)
    {
        return Section::guests($include_hidden)->sectionByName($name)->first();
    }

    protected function render()
    {
        if ($this->section != null) {
        }

        abort(404);
    }

}
