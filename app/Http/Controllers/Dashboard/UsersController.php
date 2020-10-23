<?php

namespace MixCode\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use MixCode\Http\Controllers\Controller;
use MixCode\User;
use MixCode\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Hash;
use MixCode\DataTables\UsersDataTable;
use MixCode\DataTables\Trashed\UsersTrashedDataTable;

class UsersController extends Controller
{
    protected $viewPath = 'dashboard.users';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return User::all();
        }

        $sectionName = trans('main.show_all') . ' ' . trans('main.users');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("{$this->viewPath}.create", [
            'sectionName'       => trans('main.add') . ' ' . trans('main.users'), 
            'userTypes'         => User::USER_TYPES,
            'userStatus'        => User::USER_STATUS,
             
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request, User $user)
    {
        $user = $user->register($request->validated());

        notify('success', trans('main.added-message'));

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \MixCode\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (request()->wantsJson()) {
            return $user;
        }

        $sectionName = trans('main.show') . ' ' . $user->username;

        $user->load('media');

        return view("{$this->viewPath}.show", ['sectionName' => $sectionName, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \MixCode\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $sectionName = trans('main.edit') . ' ' . $user->username;
        
        return view("{$this->viewPath}.edit", [
            'sectionName'   => $sectionName,
            'user'          => $user,
            'userTypes'         => User::USER_TYPES,
            'userStatus'        => User::USER_STATUS,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MixCode\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, User $user)
    {
        $user->updateWithMedia($request->validated());

        notify('success', trans('main.updated'));

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     * Update the specified resource password in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MixCode\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:6'],
        ]);

        $user->update(['password' => Hash::make($request->password)]);

        notify('success', trans('main.updated'));

        return redirect()->route('dashboard.users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \MixCode\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_if($user->id == auth()->id(), 401);

        $user->delete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.users.index');
    }

    public function destroyGroup(Request $request)
    {
        abort_if(in_array(auth()->id(), $request->selected_data), 401);

        User::destroy($request->selected_data);

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.users.index');
    }

    // Soft Deletes Methods

    public function trashed(UsersTrashedDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return User::all();
        }

        $sectionName = trans('main.show_all') . ' '  . trans('main.trashed') . ' ' . trans('main.users');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    public function restore($id)
    {
        $users = User::onlyTrashed()->find($id);

        $users->restore();

        notify('success', trans('main.restored'));

        return redirect()->route('dashboard.users.trashed');
    }
    
    public function forceDelete($id)
    {
        $users = User::onlyTrashed()->find($id);

        $users->forceDelete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.users.trashed');
    }
}
