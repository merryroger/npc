<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getSections(Request $request, $section = 'home')
    {
dd($section);
    }
}
