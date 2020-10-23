<?php

namespace MixCode\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use MixCode\Http\Controllers\Controller;
use MixCode\Category;
use MixCode\Http\Requests\CategoriesRequest;
use MixCode\DataTables\CategoriesDataTable;
use MixCode\DataTables\Trashed\CategoriesTrashedDataTable;

class CategoriesController extends Controller
{
    protected $viewPath = 'dashboard.categories';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoriesDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Category::all();
        }

        $sectionName = trans('main.show_all') . ' ' . trans('main.categories');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectionName = trans('main.add') . ' ' . trans('main.categories');

        return view("{$this->viewPath}.create", compact('sectionName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        $category = Category::create($request->all());

        if ($request->hasFile('icon')) {
            $category->uploadSingleMediaFromRequest('icon', 'icon');
        }

        notify('success', trans('main.added-message'));

        return redirect()->route('dashboard.categories.show', $category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \MixCode\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if (request()->wantsJson()) {
            return $category;
        }

        $sectionName = trans('main.show') . ' ' . $category->name_by_lang;

        return view("{$this->viewPath}.show", compact('sectionName', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \MixCode\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $sectionName = trans('main.edit') . ' ' . $category->name_by_lang;
        
        return view("{$this->viewPath}.edit", compact('sectionName', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MixCode\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequest $request, Category $category)
    {
        $category->update($request->all());

        if ($request->hasFile('icon')) {
            $category->updateSingleMediaFromRequest('icon', 'icon');
        }

        notify('success', trans('main.updated'));

        return redirect()->route('dashboard.categories.show', $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \MixCode\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.categories.index');
    }

    public function destroyGroup(Request $request)
    {
        Category::destroy($request->selected_data);

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.categories.index');
    }

    // Soft Deletes Methods
    public function trashed(CategoriesTrashedDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Category::all();
        }

        $sectionName = trans('main.show_all') . ' '  . trans('main.trashed') . ' ' . trans('main.categories');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    public function restore($id)
    {
        $categories = Category::onlyTrashed()->find($id);

        $categories->restore();

        notify('success', trans('main.restored'));

        return redirect()->route('dashboard.categories.trashed');
    }
    
    public function forceDelete($id)
    {
        $categories = Category::onlyTrashed()->find($id);

        $categories->forceDelete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.categories.trashed');
    }
}
