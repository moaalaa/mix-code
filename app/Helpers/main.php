<?php


function dashboardUrl($url)
{
    return url("/dashboard/{$url}");
}

function userCan($permission)
{
    if (session()->has('user.permissions')) {
        return in_array($permission, session('user.permissions'));
    } else {
        // get the user permissions depending on then roles
        $permissions = auth()->user()->getAllPermissions()->pluck('name')->toArray();
        // save the permissions to can Check on the permissions
        session()->put('user.permissions', $permissions);

        return in_array($permission, session('user.permissions'));
    }
}

function getLanguage()
{
    return app()->getLocale();
}

function isLang($langShortKey)
{
    return getLanguage() == $langShortKey;
}

function getDirection()
{
    return isLang('ar') ? 'rtl' : 'ltr';
}

function getRtlDirection()
{
    return isLang('ar') ? '.rtl' : '';
}

function isRtl()
{
    return isLang('ar') ? true : false;
}

function encodeVar($var)
{
    return json_encode($var, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

function defaultSettings()
{
    return config('defaults.settings');
}

// function defaultMainBranch()
// {
//     return config('defaults.main_branch');
// }

function getSettings()
{
    $settings = cache()->rememberForever('settings', function () {
        $settings = \MixCode\Setting::first();

        if (!! $settings) return $settings->load('media');

        return \MixCode\Setting::create(defaultSettings())->load('media');
    });

    return $settings;
}

// function getMainBranch()
// {
//     $branches = cache()->rememberForever('branches', function () {
//         $branches = \MixCode\Branch::first();

//         if (!! $branches) return $branches;

//         return \MixCode\Branch::create(defaultMainBranch());
//     });

//     return $branches;
// }

function notify($type, $title, $message = '', $notifyType = 'toast') 
{
    if ($notifyType == 'alert') {
        
        alert($title, $message, $type);
    } else if ($notifyType =='toast') {
        toast($title, $type);
    }
    
}

function shortCleanString($content, $limit = 100, $end = '...') 
{
    if (!! $limit) {
        $content = Str::limit($content, $limit, $end);
    }

    return html_entity_decode(strip_tags(trim($content)));
}