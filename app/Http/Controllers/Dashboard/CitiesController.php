<?php

namespace MixCode\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use MixCode\Http\Controllers\Controller;
use MixCode\City;
use MixCode\Country;
use MixCode\Http\Requests\CitiesRequest;
use MixCode\DataTables\CitiesDataTable;
use MixCode\DataTables\Trashed\CitiesTrashedDataTable;

class CitiesController extends Controller
{
    protected $viewPath = 'dashboard.cities';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CitiesDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return City::all();
        }

        $sectionName = trans('main.show_all') . ' ' . trans('main.cities');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectionName = trans('main.add') . ' ' . trans('main.cities');
        $countries = Country::active()->get();

        return view("{$this->viewPath}.create", compact('sectionName', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CitiesRequest $request)
    {
        $city = City::create($request->all());

        if ($request->hasFile('image')) {
            $city->uploadSingleMediaFromRequest('image');
        }

        notify('success', trans('main.added-message'));

        return redirect()->route('dashboard.cities.show', $city);
    }

    /**
     * Display the specified resource.
     *
     * @param  \MixCode\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        if (request()->wantsJson()) {
            return $city;
        }

        $sectionName = trans('main.show') . ' ' . $city->name_by_lang;
        $city->load('country');

        return view("{$this->viewPath}.show", compact('sectionName', 'city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \MixCode\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $sectionName = trans('main.edit') . ' ' . $city->name_by_lang;
        $countries = Country::active()->get();

        return view("{$this->viewPath}.edit", compact('sectionName', 'countries', 'city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MixCode\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(CitiesRequest $request, City $city)
    {
        $city->update($request->all());

        if ($request->hasFile('image')) {
            $city->updateSingleMediaFromRequest('image');
        }

        notify('success', trans('main.updated'));

        return redirect()->route('dashboard.cities.show', $city);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \MixCode\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.cities.index');
    }

    public function destroyGroup(Request $request)
    {
        City::destroy($request->selected_data);

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.cities.index');
    }

    // Soft Deletes Methods
    public function trashed(CitiesTrashedDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return City::all();
        }

        $sectionName = trans('main.show_all') . ' '  . trans('main.trashed') . ' ' . trans('main.cities');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    public function restore($id)
    {
        $cities = City::onlyTrashed()->find($id);

        $cities->restore();

        notify('success', trans('main.restored'));

        return redirect()->route('dashboard.cities.trashed');
    }
    
    public function forceDelete($id)
    {
        $cities = City::onlyTrashed()->find($id);

        $cities->forceDelete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.cities.trashed');
    }

    /**
     * Get Cities By Country for create and edit pages
     *
     * @param Request $request
     * @return view
     */
    public function getByCountry(Request $request)
    {
        $cities = [];
        $country = Country::find($request->country_id);

        if (!! $country) {
            $cities = $country->cities;
        }

        return view("{$this->viewPath}.fields.getByCountry", compact('cities'));
    }
}
