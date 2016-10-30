<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController AS Controller;
use Illuminate\Database\QueryException as Exception;
use Session;
use App\Http\Requests\VideoRequest;
use App\Models\Tag;
use App\Models\Video;
use App\Models\Gallery;


class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $videos = Video::paginate(15);
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $galleries = Gallery::pluck('name', 'id');
        $selected_galleries = [];

        $tags = Tag::pluck('name', 'id');
        $selected_tags = [];

        return view('admin.videos.create', compact('galleries', 'selected_galleries', 'tags', 'selected_tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(VideoRequest $request)
    {
        try {
            $data = $request->only(['provider', 'title', 'summary', 'source', 'display']);
            $video = Video::create($data);

            $gallery_ids = $request->input('gallery_ids');
            $video->galleries()->attach($gallery_ids);

            $tag_ids = $request->input('tag_ids');
            $video->tags()->attach($tag_ids);

            Session::flash('message', 'Video added!');
            return redirect('admin/videos');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Video $video
     *
     * @return void
     */
    public function show(Video $video)
    {
        $galleries = $video->galleries()->get();
        $tags = $video->tags()->get();
        return view('admin.videos.show', compact('video', 'galleries', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Video $video
     *
     * @return void
     */
    public function edit(Video $video)
    {
        $galleries = Gallery::pluck('name', 'id');
        $selected_galleries = $video->galleries()->pluck('id')->toArray();
        $tags = Tag::pluck('name', 'id');
        $selected_tags = $video->tags()->pluck('id')->toArray();

        return view('admin.videos.edit', compact('video', 'galleries', 'selected_galleries', 'tags', 'selected_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Video $video
     *
     * @return void
     */
    public function update(Video $video, VideoRequest $request)
    {
        try {
            $data = $request->only(['provider', 'title', 'summary', 'source', 'display']);
            $video->update($data);

            $gallery_ids = $request->input('gallery_ids');
            $video->galleries()->sync($gallery_ids);

            $tag_ids = $request->input('tag_ids');
            $video->tags()->sync($tag_ids);

            Session::flash('message', 'Video updated!');
            return redirect('admin/videos');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Video $video
     *
     * @return void
     */
    public function destroy(Video $video)
    {
        try {
            $title = $video->title;
            $video->delete();
            Session::flash('message', $title . ' has been moved to the Trash.');
            return redirect('admin/videos');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }
    }

}
