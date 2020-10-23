<?php

namespace MixCode\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MixCode\Contact;
use MixCode\Http\Controllers\Controller;
use MixCode\Http\Requests\ContactsRequest;
use MoaAlaa\ApiResponder\ApiResponder;

class ContactsController extends Controller
{
    use ApiResponder;

    public function store(ContactsRequest $request)
    {
        Contact::create($request->validated());

        return $this->api()->response([], trans('main.thanks_for_your_message'), Response::HTTP_CREATED);
    }
}
