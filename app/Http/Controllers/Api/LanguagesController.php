<?php

namespace MixCode\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MixCode\Http\Controllers\Controller;
use MixCode\Language;
use MoaAlaa\ApiResponder\ApiResponder;

class LanguagesController extends Controller
{
    use ApiResponder;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->api()->response(Language::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \MixCode\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        return $this->api()->response($language);
    }
}
