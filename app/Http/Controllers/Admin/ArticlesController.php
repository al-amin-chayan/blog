<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Admin\AdminController AS Controller;

use App\Models\Article;
use App\Models\Subject;
use App\Models\Tag;
use Illuminate\Database\QueryException as Exception;
use Session;
use Auth;
use Image;
use Carbon\Carbon;

class ArticlesController extends Controller
{

    /**
     * Article image Upload Path
     */
    const UPLOAD_DIR = '/uploads/article-image/';

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $articles = Article::with('subject')->where('user_id', Auth::user()->id)->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $subjects = Subject::orderBy('name')->pluck('name', 'id');

        $tags = Tag::pluck('name', 'id');
        $selected_tags = [];

        //return view('admin.articles.create')->with('subjects', $subjects);
        return view('admin.articles.create', compact(['subjects', 'tags', 'selected_tags']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(ArticleRequest $request)
    {
        try {
            $data = $request->only(['subject_id', 'title', 'sub_title', 'summary', 'details', 'display']);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                //dd($file);
                $data['image'] = $this->uploadImage($file);
            } else {
                $data['image'] = null;
            }

            $article = Article::create($data);

            $tag_ids = $request->input('tag_ids');
            $article->tags()->attach($tag_ids);

            Session::flash('flash_message', 'Article added!');
            return redirect('admin/articles');
        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Article $article
     *
     * @return void
     */
    public function show(Article $article)
    {
        $tags = $article->tags()->get();
        return view('admin.articles.show', compact('article', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Article $article
     *
     * @return void
     */
    public function edit(Article $article)
    {
        //$subjects = Subject::lists('name', 'id');

        $tags = Tag::pluck('name', 'id');
        $selected_tags = $article->tags()->pluck('id')->toArray();

        $subjects = Subject::pluck('name', 'id');
        return view('admin.articles.edit', compact('article', 'subjects', 'tags', 'selected_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Article $article
     *
     * @return void
     */
    public function update(Article $article, ArticleRequest $request)
    {
        try {
            $data = $request->only(['subject_id', 'title', 'sub_title', 'summary', 'details', 'display']);

            if ($request->hasFile('image')) {
                $this->unlinkImage($article->image);
                $file = $request->file('image');
                //dd($file);
                $data['image'] = $this->uploadImage($file);
            } else {
                $data['image'] = null;
            }

            $article->update($data);

            $tag_ids = $request->input('tag_ids');
            $article->tags()->sync($tag_ids);

            Session::flash('flash_message', 'Article updated!');
            return redirect('admin/articles');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article $article
     *
     * @return void
     */
    public function destroy(Article $article)
    {
        try {
            $article->delete();
            Session::flash('flash_message', 'Article deleted!');
            return redirect('admin/articles');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
        }
    }

    /**
     * Upload profile Picture.
     *
     * @param  array $file
     *
     * @return string
     */
    private function uploadImage($file)
    {
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $image_file_name = $timestamp . '.' . $file->getClientOriginalExtension();
        Image::make($file)->save(public_path() . self::UPLOAD_DIR . $image_file_name);
        //$file->move(public_path() . self::UPLOAD_DIR, $image_file_name);
        return $image_file_name;
    }

    /**
     * Remove Image.
     *
     * @param  string $img
     *
     * @return void
     */
    private function unlinkImage($img)
    {
        if ($img != '' && file_exists(public_path() . self::UPLOAD_DIR . $img)) {
            @unlink(public_path() . self::UPLOAD_DIR . $img);
        }
    }
}
