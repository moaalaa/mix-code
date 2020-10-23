<?php

namespace MixCode\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use MixCode\Http\Controllers\Controller;
use MixCode\Http\Requests\PortfoliosRequest;
use MixCode\DataTables\PortfoliosDataTable;
use MixCode\DataTables\Trashed\PortfoliosTrashedDataTable;
use MixCode\Category;
use MixCode\Client;
use MixCode\Portfolio;
  

class PortfoliosController extends Controller
{
    protected $viewPath = 'dashboard.portfolios';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PortfoliosDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Portfolio::where('creator_id', auth()->id())->get();
        }

        $sectionName = trans('main.show_all') . ' ' . trans('main.portfolios');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectionName = trans('main.add') . ' ' . trans('main.portfolios');
        $user = auth()->user();

       
         $categories = Category::active()->get();
         $clients    = Client::get();
      


        return view("{$this->viewPath}.create", compact(
            'sectionName', 
             'categories' ,
             'clients'
         ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortfoliosRequest $request, Portfolio $portfolio)
    { 
        
        $portfolio = $portfolio->create($request->all());

        if ($request->has('images')) {
            $portfolio->uploadSingleMediaFromRequest('images');
        }

        notify('success', trans('main.added-message'));

        return redirect()->route('dashboard.portfolios.show', $portfolio);
    }

    /**
     * Display the specified resource.
     *
     * @param  \MixCode\Portfolio  $Portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        $sectionName = trans('main.show') . ' ' . $portfolio->name_by_lang;

        $portfolio->load(['media', 'category','client']);

        return view("{$this->viewPath}.show", compact('sectionName', 'portfolio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \MixCode\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
 
        $sectionName = trans('main.edit') . ' ' . $portfolio->name_by_lang;
        $user = auth()->user();

         $categories  = Category::active()->get();
         $clients    = Client::get();
          
        return view("{$this->viewPath}.edit", compact(
            'sectionName', 
            'portfolio', 
            'categories'  ,
            'clients'
            
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MixCode\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(PortfoliosRequest $request, Portfolio $portfolio)
    {
    

        $portfolio = $portfolio->update($request->all());

        
        if ($request->has('images')) {
            $portfolio->updateSingleMediaFromRequest('images');
        }

        notify('success', trans('main.updated'));

        return redirect()->route('dashboard.portfolios.show', $portfolio);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \MixCode\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
 
        $portfolio->delete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.portfolios.index');
    }

    public function destroyGroup(Request $request)
    {
        Portfolio::select('creator_id')
            ->whereIn('id', $request->selected_data)
            ->get()
            ->pluck('creator_id')
            ->map(function ($portfolio_creator_id) {
                abort_unless($portfolio_creator_id === auth()->id(), Response::HTTP_FORBIDDEN);
            });


        Portfolio::destroy($request->selected_data);

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.portfolios.index');
    }

    // Soft Deletes Methods
    public function trashed(PortfoliosTrashedDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Portfolio::where('creator_id', auth()->id())->get();
        }

        $sectionName = trans('main.show_all') . ' '  . trans('main.trashed') . ' ' . trans('main.portfolios');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    public function restore($id)
    {
        $portfolio = Portfolio::onlyTrashed()->find($id);

 
        $portfolio->restore();

        notify('success', trans('main.restored'));

        return redirect()->route('dashboard.portfolios.trashed');
    }
    
    public function forceDelete($id)
    {
        $portfolio = Portfolio::onlyTrashed()->find($id);

         
        $portfolio->forceDelete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.portfolios.trashed');
    }

    public function destroyMedia(Portfolio $portfolio, Request $request)
    {    
 
        if (! $portfolio) {
            return response()->json(['status' => false, 'message' => trans('main.not_found')]);
        }

        if (! $request->has('media_id')) {
            return response()->json(['status' => false, 'message' => trans('main.not_found')]);
        }

        // Method Exists in HasMediaTrait
        $portfolio->deleteMedia($request->media_id);

        return response()->json(['status' => true, 'message' => trans('main.deleted-message')]);
    }
}
