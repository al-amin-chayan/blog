<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GalleryRequest;
use App\Http\Controllers\Admin\AdminController AS Controller;
use App\Models\Video;
use App\Models\Gallery;
use Illuminate\Database\QueryException as Exception;
use Session;

class GalleriesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index() {
        $galleries = Gallery::paginate(15);
        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create() {
        $videos = Video::select('id', 'provider', 'title', 'source', 'display')->get();
        $selected_videos = [];

        return view('admin.galleries.create', compact('videos', 'selected_videos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GalleryRequest $request
     *
     * @return void
     */
    public function store(GalleryRequest $request) {
        try {
            $data = $request->only(['name', 'description', 'display']);
            $gallery = Gallery::create($data);

            $video_ids = $request->input('video_ids');
            $gallery->videos()->attach($video_ids);

            Session::flash('message', 'Gallery added!');
            return redirect('admin/galleries');
        } catch (Exception $e) {
            return redirect()->back()
                            ->withErrors($e->getMessage())
                            ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Gallery $gallery
     *
     * @return void
     */
    public function show(Gallery $gallery) {
        $videos = $gallery->videos()->get();

        return view('admin.galleries.show', compact('gallery', 'videos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Gallery $gallery
     *
     * @return void
     */
    public function edit(Gallery $gallery) {
        $videos = Video::select('id', 'provider', 'title', 'source', 'display')->get();
        $selected_videos = $gallery->videos()->pluck('id')->toArray();

        return view('admin.galleries.edit', compact('gallery', 'videos', 'selected_videos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Gallery $gallery
     *
     * @param  GalleryRequest $request
     *
     * @return void
     */
    public function update(Gallery $gallery, GalleryRequest $request) {
        try {
            $data = $request->only(['name', 'description', 'display']);
            $gallery->update($data);

            $video_ids = $request->input('video_ids');
            $gallery->videos()->sync($video_ids);

            Session::flash('message', 'Gallery updated!');
            return redirect('admin/galleries');
        } catch (Exception $e) {
            return redirect()->back()
                            ->withErrors($e->getMessage())
                            ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Gallery $gallery
     *
     * @return void
     */
    public function destroy(Gallery $gallery) {
        try {
            $name = $gallery->name;
            $gallery->delete();
            Session::flash('message', $name . ' has been moved to the Trash.');
            return redirect('admin/galleries');
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
    public function trash() {
        $galleries = Gallery::onlyTrashed()->paginate(15);
        return view('admin.galleries.trash', compact('galleries'));
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int $id
     *
     * @return void
     */
    public function restore($id) {
        $gallery = Gallery::withTrashed()->findOrFail($id);
        try {
            $name = $gallery->name;
            $gallery->restore();
            Session::flash('message', $name . ' has been restored.');
            return redirect('admin/galleries/trash');
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
    public function clean($id) {
        $gallery = Gallery::withTrashed()->findOrFail($id);
        try {
            $name = $gallery->name;
            $gallery->forceDelete();
            Session::flash('message', $name . ' has been deleted.');
            return redirect('admin/galleries/trash');
        } catch (Exception $e) {
            return redirect()->back()
                            ->withErrors($e->getMessage());
        }
    }

}
