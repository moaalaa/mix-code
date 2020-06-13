<?php

namespace MixCode\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MixCode\Http\Controllers\Controller;
use MixCode\Http\Requests\ServicesRequest;
use MixCode\DataTables\ServicesDataTable;
use MixCode\DataTables\Trashed\ServicesTrashedDataTable;
use MixCode\Service ;
 

class ServicesController extends Controller
{
    protected $viewPath = 'dashboard.services';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ServicesDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Service::where('creator_id', auth()->id())->get();
        }

        $sectionName = trans('main.show_all') . ' ' . trans('main.services');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectionName = trans('main.add') . ' ' . trans('main.services');
        $user = auth()->user();


        return view("{$this->viewPath}.create", compact('sectionName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServicesRequest $request, Service $service)
    {
        $service = $service->createNewService($request);

        if ($request->has('images')) {
            $service->uploadSingleMediaFromRequest('images');
        }

        notify('success', trans('main.added-message'));

        return redirect()->route('dashboard.services.show', $service);
    }

    /**
     * Display the specified resource.
     *
     * @param  \MixCode\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $sectionName = trans('main.show') . ' ' . $service->name_by_lang;

        $service->load('media');

        return view("{$this->viewPath}.show", compact('sectionName', 'service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \MixCode\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
 
        $sectionName = trans('main.edit') . ' ' . $service->name_by_lang;
        $user = auth()->user();

          
        return view("{$this->viewPath}.edit", compact( 'sectionName',  'service' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MixCode\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServicesRequest $request, Service $service)
    {
    

        $service = $service->updateService($request);

        
        if ($request->has('images')) {
            $service->updateSingleMediaFromRequest('images');
        }

        notify('success', trans('main.updated'));

        return redirect()->route('dashboard.services.show', $service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \MixCode\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);

        $service->delete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.services.index');
    }

    public function destroyGroup(Request $request)
    {
        Service::select('creator_id')
            ->whereIn('id', $request->selected_data)
            ->get()
            ->pluck('creator_id')
            ->map(function ($service_creator_id) {
                abort_unless($service_creator_id === auth()->id(), Response::HTTP_FORBIDDEN);
            });


        Service::destroy($request->selected_data);

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.services.index');
    }

    // Soft Deletes Methods
    public function trashed(ServicesTrashedDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Service::where('creator_id', auth()->id())->get();
        }

        $sectionName = trans('main.show_all') . ' '  . trans('main.trashed') . ' ' . trans('main.services');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    public function restore($id)
    {
        $service = Service::onlyTrashed()->find($id);

        $this->authorize('restore', $service);

        $service->restore();

        notify('success', trans('main.restored'));

        return redirect()->route('dashboard.services.trashed');
    }
    
    public function forceDelete($id)
    {
        $service = Service::onlyTrashed()->find($id);

        $this->authorize('forceDelete', $service);
        
        $service->forceDelete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.services.trashed');
    }

    public function destroyMedia(Service $service, Request $request)
    {    
        $this->authorize('view', $service);

        if (! $service) {
            return response()->json(['status' => false, 'message' => trans('main.not_found')]);
        }

        if (! $request->has('media_id')) {
            return response()->json(['status' => false, 'message' => trans('main.not_found')]);
        }

        // Method Exists in HasMediaTrait
        $service->deleteMedia($request->media_id);

        return response()->json(['status' => true, 'message' => trans('main.deleted-message')]);
    }
}
