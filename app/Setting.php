<?php

namespace MixCode;

use DOMDocument;
use Illuminate\Database\Eloquent\Model;
use MixCode\Utils\UsingMedia;
use MixCode\Utils\RefreshCache;
use MixCode\Utils\UsingUuid;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Setting extends Model implements HasMedia
{
    use UsingUuid, RefreshCache, HasMediaTrait, UsingMedia;
    
    protected $appends = [
        'about_us_by_lang',
        'mission_by_lang', 
        'vision_by_lang', 
       
        'terms_and_conditions_by_lang', 
        'media_links'
     ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'snapchat',
        'youtube',
        'en_about_us',
        'ar_about_us',
        'en_mission',
        'ar_mission',
        'en_vision',
        'ar_vision',   
        'en_tactics',
        'ar_tactics',
         'en_terms_and_conditions',
        'ar_terms_and_conditions',
        'map_url',
    ];

    public function updateWithImages($request)
    {
        $data = $request->all();

        
        $this->update($data);
    }

    /**
     * Get The Map Url "src attribute" From html "iframe" element
     *
     * @see https://www.coralnodes.com/parsing-html-in-php/
     * @param string $map_url
     * @return $this
     */
    public function updateMapUrl($map_url)
    {
        // Check if map url is jus link or iframe html element 
        if (! $this->isHtmlElement($map_url)) {
            
            $this->update(['map_url' => $map_url]);
        
            return $this;
        }
            
        try {
            // Use DOM Class
            $dom = new DOMDocument();
            
            // Check Whether the dom loaded the "iframe" element successfully
            if ($dom->loadHTML($map_url)) {

                // Get Iframe Element from DOM
                $iframe = $dom->getElementsByTagName('iframe');
   
                // Check if i frame found
                if ($iframe->count() > 0) {
                    // Ge First Iframe and get its "src" attribute
                    $map = $iframe->item(0)->getAttribute('src');

                    // Update Setting
                    $this->update(['map_url' => $map]);
                }
            }
            
        } catch (\Exception $th) { }

        return $this;
    }

    /**
     * Detect Whether the string is an HTMl Element or not
     *
     * @see https://subinsb.com/php-check-if-string-is-html/
     * @param string $string
     * @return boolean
     */
    public function isHtmlElement($string)
    {
        return $string != strip_tags($string);
    }



    public function mediaLinks()
    {
        $media = $this->allMedia();

        $links = $media->map(function ($m){
            return $this->safeMediaUrl($m->getUrl());
        });
        
        return $links;
    }



    public function getAboutUsByLangAttribute()
    {
        $field = $this->getLang() . '_about_us';

        return $this->{$field};
    }
    
    public function getMissionByLangAttribute()
    {
        $field = $this->getLang() . '_mission';

        return $this->{$field};    
    }

    public function getVisionByLangAttribute()
    {
        $field = $this->getLang() . '_vision';

        return $this->{$field};
    }

    public function getValuesByLangAttribute()
    {
        $field = $this->getLang() . '_values';

        return $this->{$field};
    }

    public function getTermsAndConditionsByLangAttribute()
    {
        $field = $this->getLang() . '_terms_and_conditions';

        return $this->{$field};
    }

    public function getCallToActionByLangAttribute()
    {
        $field = $this->getLang() . '_call_to_action';

        return $this->{$field};
    }

    /**
     * Return lang key based on if request wants json response for api
     *
     * @return string
     */
    protected function getLang()
    {
        return request()->wantsJson() ? $this->hasLang() : app()->getLocale();
    }

    /**
     * return lang key if exists in request or fall back to "en"
     *
     * @return string
     */
    protected function hasLang() 
    {
        return (request()->has('lang') && request()->filled('lang')) ? request('lang') : 'ar';
    }
}
