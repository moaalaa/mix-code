<?php

namespace MixCode;

class MultiLanguageManager
{
    public static function changeLanguage($language)
    {
        if (!! $language) {
            static::saveLanguage($language);
        } else {
            static::saveLanguage(config('app.fallback_locale')); // en fallback
        }
    }

    protected static function saveLanguage($language)
    {
        // If User Auth
        if (auth()->check()) {
            // Get User Language
            static::saveLanguageForUser($language);

        } else if (session()->has('lang')) { // If User Not loggedIn Get Default If Was Guest
            static::saveLanguageInSession($language, true);
        } else {
            static::saveLanguageInSession($language);
        }

        return $language;
    }

    protected static function saveLanguageForUser($language)
    {
        auth()->user()->update(['lang' => $language]);
    }

    protected static function saveLanguageInSession($language, $exists = false)
    {
        if ($exists) {
            session()->forget('lang');
        }

        session()->put('lang', $language);
    }

    public static function getLanguage()
    {
        if (auth()->check()) {
            return static::getLanguageFromUser();
        } else if (session()->has('lang')) {
            return static::getLanguageFromSession();
        } else {
            return config('app.fallback_locale');
        }
    }

    protected static function getLanguageFromUser()
    {
        $lang = auth()->user()->lang;
                
        return !! $lang ? $lang : config('app.fallback_locale');
    }

    protected static function getLanguageFromSession()
    {
        return session()->get('lang');
    }
}
