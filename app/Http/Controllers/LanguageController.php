<?php

namespace MixCode\Http\Controllers;

use Illuminate\Http\Request;
use MixCode\MultiLanguageManager;

class LanguageController extends Controller
{
    public function changeLanguage($language = null)
    {
        MultiLanguageManager::changeLanguage($language);

        return back();
    }
    
    public function getLanguage()
    {
        return MultiLanguageManager::getLanguage();
    }
}
