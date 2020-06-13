<?php

namespace MixCode\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MixCode\Http\Controllers\Controller;
use MixCode\Language;
use MixCode\Http\Requests\LanguagesRequest;
use MixCode\DataTables\LanguagesDataTable;
use MixCode\DataTables\Trashed\LanguagesTrashedDataTable;

class LanguagesController extends Controller
{
    protected $viewPath = 'dashboard.languages';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LanguagesDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Language::where('creator_id', auth()->id())->get();
        }

        $sectionName = trans('main.show_all') . ' ' . trans('main.languages');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectionName = trans('main.add') . ' ' . trans('main.languages');

        return view("{$this->viewPath}.create", compact('sectionName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguagesRequest $request)
    {
        $language = Language::create($request->all());

        notify('success', trans('main.added-message'));

        return redirect()->route('dashboard.languages.show', $language);
    }

    /**
     * Display the specified resource.
     *
     * @param  \MixCode\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        $this->authorize('view', $language);

        if (request()->wantsJson()) {
            return $language;
        }

        $sectionName = trans('main.show') . ' ' . $language->name_by_lang;

        return view("{$this->viewPath}.show", compact('sectionName', 'language'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \MixCode\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        $this->authorize('view', $language);

        $sectionName = trans('main.edit') . ' ' . $language->name_by_lang;
        
        return view("{$this->viewPath}.edit", compact('sectionName', 'language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MixCode\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(LanguagesRequest $request, Language $language)
    {
        $this->authorize('update', $language);

        $language->update($request->all());

        notify('success', trans('main.updated'));

        return redirect()->route('dashboard.languages.show', $language);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \MixCode\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        $this->authorize('delete', $language);

        $language->delete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.languages.index');
    }

    public function destroyGroup(Request $request)
    {
        Language::select('creator_id')
            ->whereIn('id', $request->selected_data)
            ->get()
            ->pluck('creator_id')
            ->map(function ($language_creator_id) {
                abort_unless($language_creator_id === auth()->id(), Response::HTTP_FORBIDDEN);
            });

        Language::destroy($request->selected_data);

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.languages.index');
    }

    // Soft Deletes Methods
    public function trashed(LanguagesTrashedDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Language::where('creator_id', auth()->id())->get();
        }

        $sectionName = trans('main.show_all') . ' '  . trans('main.trashed') . ' ' . trans('main.languages');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    public function restore($id)
    {
        $language = Language::onlyTrashed()->find($id);

        $this->authorize('restore', $language);

        $language->restore();

        notify('success', trans('main.restored'));

        return redirect()->route('dashboard.languages.trashed');
    }
    
    public function forceDelete($id)
    {
        $language = Language::onlyTrashed()->find($id);

        $this->authorize('forceDelete', $language);

        $language->forceDelete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.languages.trashed');
    }
}
