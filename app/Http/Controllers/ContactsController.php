<?php

namespace MixCode\Http\Controllers;

use Illuminate\Http\Request;
use MixCode\Contact;
use MixCode\Http\Requests\ContactsRequest;
use MixCode\Utils\UsingSEO;

class ContactsController extends Controller
{
    use UsingSEO;
    
    public function index()
    {
        tap(trans('site.contact_us'), function ($seoTitle) {
            $this->seo()->generate(['title' => $seoTitle, 'description' => config('app.name') . ' ' . $seoTitle]);
        });

        return view('contact');
    }

    public function store(ContactsRequest $request)
    {
        Contact::create($request->validated());
        
        notify('success', trans('main.thanks_for_your_message'));

        return back();
    }
}
