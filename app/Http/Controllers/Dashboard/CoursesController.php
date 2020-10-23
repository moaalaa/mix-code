<?php

namespace MixCode\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MixCode\Http\Controllers\Controller;
use MixCode\Http\Requests\CoursesRequest;
use MixCode\DataTables\CoursesDataTable;
use MixCode\DataTables\Trashed\CoursesTrashedDataTable;
use MixCode\Course ;
 

class CoursesController extends Controller
{
    protected $viewPath = 'dashboard.courses';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CoursesDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Course::where('creator_id', auth()->id())->get();
        }

        $sectionName = trans('main.show_all') . ' ' . trans('main.courses');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectionName = trans('main.add') . ' ' . trans('main.course');
        $user = auth()->user();


        return view("{$this->viewPath}.create", compact('sectionName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoursesRequest $request, Course $course)
    {
        $course = $course->createNewCourse($request);

        if ($request->has('images')) {
            $course->uploadSingleMediaFromRequest('images');
        }

        notify('success', trans('main.added-message'));

        return redirect()->route('dashboard.courses.show', $course);
    }

    /**
     * Display the specified resource.
     *
     * @param  \MixCode\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $sectionName = trans('main.show') . ' ' . $course->name_by_lang;

        $course->load('media');

        return view("{$this->viewPath}.show", compact('sectionName', 'course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \MixCode\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
 
        $sectionName = trans('main.edit') . ' ' . $course->name_by_lang;
        $user = auth()->user();

          
        return view("{$this->viewPath}.edit", compact( 'sectionName',  'course' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MixCode\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(CoursesRequest $request, Course $course)
    {
    

        $course = $course->updateCourse($request);

        
        if ($request->has('images')) {
            $course->updateSingleMediaFromRequest('images');
        }

        notify('success', trans('main.updated'));

        return redirect()->route('dashboard.courses.show', $course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \MixCode\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);

        $course->delete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.courses.index');
    }

    public function destroyGroup(Request $request)
    {
        Course::select('creator_id')
            ->whereIn('id', $request->selected_data)
            ->get()
            ->pluck('creator_id')
            ->map(function ($course_creator_id) {
                abort_unless($course_creator_id === auth()->id(), Response::HTTP_FORBIDDEN);
            });


        Course::destroy($request->selected_data);

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.courses.index');
    }

    // Soft Deletes Methods
    public function trashed(CoursesTrashedDataTable $dataTable)
    {
        if (app()->environment('testing') && request()->wantsJson()) {
            return Course::where('creator_id', auth()->id())->get();
        }

        $sectionName = trans('main.show_all') . ' '  . trans('main.trashed') . ' ' . trans('main.courses');

        return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
    }

    public function restore($id)
    {
        $course = Course::onlyTrashed()->find($id);

        $this->authorize('restore', $course);

        $course->restore();

        notify('success', trans('main.restored'));

        return redirect()->route('dashboard.courses.trashed');
    }
    
    public function forceDelete($id)
    {
        $course = Course::onlyTrashed()->find($id);

        $this->authorize('forceDelete', $course);
        
        $course->forceDelete();

        notify('success', trans('main.deleted-message'));

        return redirect()->route('dashboard.courses.trashed');
    }

    public function destroyMedia(Course $course, Request $request)
    {    
        $this->authorize('view', $course);

        if (! $course) {
            return response()->json(['status' => false, 'message' => trans('main.not_found')]);
        }

        if (! $request->has('media_id')) {
            return response()->json(['status' => false, 'message' => trans('main.not_found')]);
        }

        // Method Exists in HasMediaTrait
        $course->deleteMedia($request->media_id);

        return response()->json(['status' => true, 'message' => trans('main.deleted-message')]);
    }
}
