<?php

namespace MixCode\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use MixCode\Http\Controllers\Controller;
use MixCode\Http\Requests\ClientsRequest;
use MixCode\DataTables\ClientsDataTable;
use MixCode\DataTables\Trashed\ClientsTrashedDataTable;
use MixCode\Category;
use MixCode\Client;
  

class ClientsController extends Controller
{
    protected $viewPath = 'dashboard.clients';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClientsDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Client::where('creator_id', auth()->id())->get();
        }

        $sectionName = trans('main.show_all') . ' ' . trans('main.clients');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectionName = trans('main.add') . ' ' . trans('main.clients');
        $user = auth()->user();
 
  
        return view("{$this->viewPath}.create", compact(
            'sectionName' 
         ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientsRequest $request, Client $client)
    { 

        
        $client = $client->createNewClient($request);

        if ($request->has('image')) {
            $client->uploadSingleMediaFromRequest('image');
        }

        notify('success', trans('main.added-message'));

        return redirect()->route('dashboard.clients.show', $client);
    }

    /**
     * Display the specified resource.
     *
     * @param  \MixCode\Client  $Client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $sectionName = trans('main.show') . ' ' . $client->name_by_lang;

        $client->load(['media']);

        return view("{$this->viewPath}.show", compact('sectionName', 'client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \MixCode\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
 
        $sectionName = trans('main.edit') . ' ' . $client->name_by_lang;
        $user = auth()->user();

           
        return view("{$this->viewPath}.edit", compact(
            'sectionName', 
            'client' 
            
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MixCode\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientsRequest $request, Client $client)
    {
    

        $client = $client->updateClient($request);

        
        if ($request->has('image')) {
            $client->updateSingleMediaFromRequest('image');
        }

        notify('success', trans('main.updated'));

        return redirect()->route('dashboard.clients.show', $client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \MixCode\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
 
        $client->delete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.clients.index');
    }

    public function destroyGroup(Request $request)
    {
        Client::select('creator_id')
            ->whereIn('id', $request->selected_data)
            ->get()
            ->pluck('creator_id')
            ->map(function ($client_creator_id) {
                abort_unless($client_creator_id === auth()->id(), Response::HTTP_FORBIDDEN);
            });


        Client::destroy($request->selected_data);

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.clients.index');
    }

    // Soft Deletes Methods
    public function trashed(ClientsTrashedDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Client::where('creator_id', auth()->id())->get();
        }

        $sectionName = trans('main.show_all') . ' '  . trans('main.trashed') . ' ' . trans('main.clients');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    public function restore($id)
    {
        $client = Client::onlyTrashed()->find($id);

 
        $client->restore();

        notify('success', trans('main.restored'));

        return redirect()->route('dashboard.clients.trashed');
    }
    
    public function forceDelete($id)
    {
        $client = Client::onlyTrashed()->find($id);

         
        $client->forceDelete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.clients.trashed');
    }

    public function destroyMedia(Client $client, Request $request)
    {    
 
        if (! $client) {
            return response()->json(['status' => false, 'message' => trans('main.not_found')]);
        }

        if (! $request->has('media_id')) {
            return response()->json(['status' => false, 'message' => trans('main.not_found')]);
        }

        // Method Exists in HasMediaTrait
        $client->deleteMedia($request->media_id);

        return response()->json(['status' => true, 'message' => trans('main.deleted-message')]);
    }
}
