<?php

namespace MixCode\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MixCode\Http\Controllers\Controller;
use MixCode\Company;
use MixCode\Http\Requests\CompaniesRequest;
use MixCode\DataTables\CompaniesDataTable;
use MixCode\DataTables\Trashed\CompaniesTrashedDataTable;

class CompaniesController extends Controller
{
    protected $viewPath = 'dashboard.companies';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CompaniesDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Company::where('creator_id', auth()->id())->get();
        }

        $sectionName = trans('main.show_all') . ' ' . trans('main.companies');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectionName = trans('main.add') . ' ' . trans('main.companies');

        return view("{$this->viewPath}.create", compact('sectionName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompaniesRequest $request)
    {
    
        $company = Company::create($request->all());

        if ($request->has('images')) {
            $company->uploadSingleMediaFromRequest('images');
        }


        notify('success', trans('main.added-message'));

        return redirect()->route('dashboard.companies.show', $company);
    }

    /**
     * Display the specified resource.
     *
     * @param  \MixCode\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {

        $sectionName = trans('main.show') . ' ' . $company->name_by_lang;

        return view("{$this->viewPath}.show", compact('sectionName', 'company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \MixCode\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        // $this->authorize('view', $company);

        $sectionName = trans('main.edit') . ' ' . $company->name_by_lang;
        
        return view("{$this->viewPath}.edit", compact('sectionName', 'company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MixCode\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompaniesRequest $request, Company $company)
    {
    

        $company->update($request->all());

        if ($request->has('images')) {
            $company->updateSingleMediaFromRequest('images');
        }

        notify('success', trans('main.updated'));

        return redirect()->route('dashboard.companies.show', $company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \MixCode\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        

        $company->delete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.companies.index');
    }

    public function destroyGroup(Request $request)
    {        
        Company::select('creator_id')
            ->whereIn('id', $request->selected_data)
            ->get()
            ->pluck('creator_id')
            ->map(function ($company_creator_id) {
                abort_unless($company_creator_id === auth()->id(), Response::HTTP_FORBIDDEN);
            });

        Company::destroy($request->selected_data);

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.companies.index');
    }

    // Soft Deletes Methods
    public function trashed(CompaniesTrashedDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Company::where('creator_id', auth()->id())->get();
        }

        $sectionName = trans('main.show_all') . ' '  . trans('main.trashed') . ' ' . trans('main.companies');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    public function restore($id)
    {
        $company = Company::onlyTrashed()->find($id);
        

        $company->restore();

        notify('success', trans('main.restored'));

        return redirect()->route('dashboard.companies.trashed');
    }
    
    public function forceDelete($id)
    {
        $company = Company::onlyTrashed()->find($id);
    

        $company->forceDelete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.companies.trashed');
    }
}
