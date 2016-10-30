<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SubjectRequest;
use App\Http\Controllers\Admin\AdminController AS Controller;

use App\Models\Subject;
use Illuminate\Database\QueryException as Exception;
use Session;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $subjects = Subject::paginate(15);
        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(SubjectRequest $request)
    {
        try {
            $data = $request->only(['name', 'description']);
            Subject::create($data);
            Session::flash('flash_message', 'Subject added!');
            return redirect('admin/subjects');
        } catch (Exception $e) {

            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Subject $subject
     *
     * @return void
     */
    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Subject $subject
     *
     * @return void
     */
    public function update(Subject $subject, SubjectRequest $request)
    {
        try {
            $data = $request->only(['name', 'description']);
            $subject->update($data);
            Session::flash('message', 'Subject updated!');
            return redirect('admin/subjects');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Subject $subject
     *
     * @return void
     */
    public function destroy(Subject $subject)
    {
        try {
            $name = $subject->name;
            $subject->delete();
            Session::flash('message', $name . ' has been moved to the Trash.');
            return redirect('admin/subjects');

        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }
    }

    /**
     * Display a listing of the trash resource.
     *
     * @return void
     */
    public function trash()
    {
        $subjects = Subject::onlyTrashed()->get();
        return view('admin.subjects.trash', compact('subjects'));
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int $id
     *
     * @return void
     */
    public function restore($id)
    {
        $subject = Subject::withTrashed()->findOrFail($id);
        try {
            $name = $subject->name;
            $subject->restore();
            Session::flash('message', $name . ' has been restored.');
            return redirect('admin/subjects/trash');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }
    }

    /**
     * Permanently Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return void
     */
    public function clean($id)
    {
        $subject = Subject::withTrashed()->findOrFail($id);
        try {
            $name = $subject->name;
            $subject->forceDelete();
            Session::flash('message', $name . ' has been deleted.');
            return redirect('admin/subjects/trash');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }
    }
}