<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProfessionRequest;

use App\Http\Controllers\Admin\AdminController AS Controller;
use App\Models\Profession;
use Session;


class ProfessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professions = Profession::with('users')->get();
        return view('admin.professions.index', compact('professions'));
    }

    public function users(Profession $profession)
    {
        $data = [
            'profession' => $profession
        ];
        return view('admin.professions.users', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.professions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfessionRequest $request)
    {
        try {
            $data = $request->only('name');
            Profession::create($data);
            Session::flash('message', 'Profession added!');
            return redirect('admin/professions');
        } catch(Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Profession $profession
     * @return \Illuminate\Http\Response
     */
    public function edit(Profession $profession)
    {
        return view('admin.professions.edit', compact('profession'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProfessionRequest $request
     * @param  Profession $profession
     * @return \Illuminate\Http\Response
     */
    public function update(ProfessionRequest $request, Profession $profession)
    {
        try {
            $data = $request->only('name');
            $profession->update($data);
            Session::flash('message', 'Profession updated!');
            return redirect('admin/professions');
        } catch(Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Profession $profession
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profession $profession)
    {
        try {
            $name = $profession->name;
            $profession->delete();
            Session::flash('message', $name . ' deleted!');
            return redirect('admin/professions');
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
        $professions = Profession::onlyTrashed()->get();
        return view('admin.professions.trash', compact('professions'));
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function restore($id)
    {
        $profession = Profession::withTrashed()->findOrFail($id);
        try {
            $name = $profession->name;
            $profession->restore();
            Session::flash('message', $name . ' restored!');
            return redirect('admin/professions/trash');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }
    }

    /**
     * Permanently Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function clean($id)
    {
        $profession = Profession::withTrashed()->findOrFail($id);
        try {
            $name = $profession->name;
            $profession->views()->delete();
            $profession->forceDelete();
            Session::flash('message', $name . ' deleted!');
            return redirect('admin/professions/trash');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }
    }
}
