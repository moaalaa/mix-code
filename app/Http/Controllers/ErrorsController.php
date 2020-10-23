<?php

namespace MixCode\Http\Controllers;

use Illuminate\Http\Request;

class ErrorsController extends Controller
{
    public function abort404()
    {
        abort(404);
    }
}
