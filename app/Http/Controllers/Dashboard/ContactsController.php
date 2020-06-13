<?php

namespace MixCode\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use MixCode\Http\Controllers\Controller;
use MixCode\Contact;
use MixCode\DataTables\ContactsDataTable;

class ContactsController extends Controller
{
    protected $viewPath = 'dashboard.contacts';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContactsDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Contact::all();
        }

        $sectionName = trans('main.show_all') . ' ' . trans('main.contacts');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \MixCode\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        if (request()->wantsJson()) {
            return $contact;
        }

        $sectionName = trans('main.show') . ' ' . $contact->name;

        return view("{$this->viewPath}.show", compact('sectionName', 'contact'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \MixCode\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.contacts.index');
    }

    public function destroyGroup(Request $request)
    {
        Contact::destroy($request->selected_data);

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.contacts.index');
    }
}
