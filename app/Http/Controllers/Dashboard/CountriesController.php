<?php

namespace MixCode\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use MixCode\Http\Controllers\Controller;
use MixCode\Country;
use MixCode\Http\Requests\CountriesRequest;
use MixCode\DataTables\CountriesDataTable;
use MixCode\DataTables\Trashed\CountriesTrashedDataTable;

class CountriesController extends Controller
{
    protected $viewPath = 'dashboard.countries';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountriesDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Country::all();
        }

        $sectionName = trans('main.show_all') . ' ' . trans('main.countries');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectionName = trans('main.add') . ' ' . trans('main.countries');

        return view("{$this->viewPath}.create", compact('sectionName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountriesRequest $request)
    {
        $country = Country::create($request->all());

        if ($request->hasFile('image')) {
            $country->uploadSingleMediaFromRequest('image');
        }

        notify('success', trans('main.added-message'));

        return redirect()->route('dashboard.countries.show', $country);
    }

    /**
     * Display the specified resource.
     *
     * @param  \MixCode\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        if (request()->wantsJson()) {
            return $country;
        }

        $sectionName = trans('main.show') . ' ' . $country->name_by_lang;

        return view("{$this->viewPath}.show", compact('sectionName', 'country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \MixCode\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        $sectionName = trans('main.edit') . ' ' . $country->name_by_lang;
        
        return view("{$this->viewPath}.edit", compact('sectionName', 'country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MixCode\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(CountriesRequest $request, Country $country)
    {
        $country->update($request->all());

        if ($request->hasFile('image')) {
            $country->updateSingleMediaFromRequest('image');
        }

        notify('success', trans('main.updated'));

        return redirect()->route('dashboard.countries.show', $country);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \MixCode\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.countries.index');
    }

    public function destroyGroup(Request $request)
    {
        Country::destroy($request->selected_data);

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.countries.index');
    }

    // Soft Deletes Methods
    public function trashed(CountriesTrashedDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Country::all();
        }

        $sectionName = trans('main.show_all') . ' '  . trans('main.trashed') . ' ' . trans('main.countries');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    public function restore($id)
    {
        $countries = Country::onlyTrashed()->find($id);

        $countries->restore();

        notify('success', trans('main.restored'));

        return redirect()->route('dashboard.countries.trashed');
    }
    
    public function forceDelete($id)
    {
        $countries = Country::onlyTrashed()->find($id);

        $countries->forceDelete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.countries.trashed');
    }
}
