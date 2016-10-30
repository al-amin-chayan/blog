<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Front\FrontController AS Controller;
use App\Models\Tag;
use App\Models\Gallery;
use App\Models\Video;
use App\Models\Comment;
use Session;
use Redirect;
use URL;

class VideoController extends Controller {

    public function show($id) {
        $video = Video::with([
            'comments' => function ($query) {
                $query->where('display', 'Y')
                        ->orderBy('created_at', 'desc');
            }, 'comments.user', 'comments.user.profile'
        ])->where('display', 'Y')
          ->find($id);
            
        if ($video->views()->exists()) {
            $video->views()->increment('view_count');
        } else {
            $video->views()->create(['view_count' => 1]);
        }
        $data = [
            'title' => $video->title,
            'video' => $video
        ];
        return view('video.show', $data);
    }

    public function gallery($id) {
        $gallery = Gallery::whereHas('videos', function ($query) {
            $query->where('videos.display', '=', 'Y')
                    ->orderBy('videos.created_at', 'desc');
        })->findOrFail($id);
        
        if ($gallery->views()->exists()) {
            $gallery->views()->increment('view_count');
        } else {
            $gallery->views()->create(['view_count' => 1]);
        }
        $data = [
            'title' => $gallery->name,
            'videos' => $gallery->videos()->paginate(3),
            'gallery_id' => $id
        ];
        return view('video.list', $data);
    }

    public function tag($id, $slug = NULL)
    {
        $tag = Tag::whereHas('videos', function ($query) {
            $query->where('display', 'Y')
                    ->orderBy('created_at', 'desc');
        })->findOrFail($id);
        
        if ($tag->views()->exists()) {
            $tag->views()->increment('view_count');
        } else {
            $tag->views()->create(['view_count' => 1]);
        }
        
        $data = [
            'title' => $tag->name,
            'videos' => $tag->videos()->paginate(3)
        ];
        return view('video.list', $data);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  CommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function comment(CommentRequest $request)
    {
        try {
            $video_id = $request->input('video_id');
            $video = Video::where('display', 'Y')->findOrFail($video_id);
            
            $comment = new Comment();
            $comment->details = $request->input('details');
            
            $video->comments()->save($comment);
            Session::flash('message', 'Comment added!');
            return Redirect::to(URL::previous() . "#comments");
        } catch(Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }
}
