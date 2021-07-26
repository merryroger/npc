<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function handleRequest(Request $request)
    {
        return response()->json($request->request->all());
    }
}
