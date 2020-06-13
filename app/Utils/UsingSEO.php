<?php

namespace MixCode\Utils;

trait UsingSEO
{
    protected $seoManager;
    
    protected function seo()
    {
        $this->seoManager = app('seotools');

        return $this;
    }

    protected function generate($data)
    {
        // Global Values
        $this->seoManager->setTitle($data['title']);
        $this->seoManager->setDescription($data['description']);
        $this->seoManager->addImages($this->loadImage($data));

        // OpenGraph Specific Values
        $this->seoManager->opengraph()->setUrl($this->loadSEOUrl($data));
        $this->seoManager->opengraph()->addProperty('type', $this->openGraphType($data));
        
        // Twitter Specific Values
        $this->seoManager->twitter()->setType($this->twitterType($data));

        // JsonLd Specific Values
        $this->seoManager->jsonLd()->setType($this->jsonLdType($data));

        return $this;
    }

    protected function loadSEOUrl($data) 
    {
        return $data['url'] ?? request()->fullUrl();
    }
    
    protected function loadImage($data) 
    {
        return $data['image'] ?? asset('/assets/img/logo.png');
    }

    protected function openGraphType($data) 
    {
        return $data['og:type'] ?? 'website';
    }
    
    protected function twitterType($data) 
    {
        return $data['twitter:type'] ?? 'summary';
    }

    protected function jsonLdType($data) 
    {
        return $data['jsonLd:type'] ?? 'WebPage';
    }

}
