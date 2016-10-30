<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Controllers\FrontController;
use App\Models\Profession;
use App\Models\Subject;
use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use Session;
use Redirect;
use URL;

class BlogController extends FrontController {

    public function home() {
        $articles = Article::where('display', 'Y')->orderBy('created_at', 'desc')->paginate(5);
        $data = [
            'title' => 'My blog',
            'sub_title' => '',
            'articles' => $articles
        ];
        return view('blog.list', $data);
    }

    public function post($id, $slug = NULL) {
        $article = Article::with([
            'comments' => function ($query) {
                $query->where('display', 'Y')
                        ->orderBy('comments.created_at', 'desc');
            }, 'comments.user', 'comments.user.profile'
        ])->where('display', 'Y')
          ->find($id);
        //$article->increment('');
        $data = [
            'title' => 'My blog',
            'sub_title' => '',
            'article' => $article
        ];
        return view('blog.post', $data);
    }

    public function profession($id) {
        $profession = Profession::whereHas('articles', function ($query) {
                    $query->where('display', 'Y')
                            ->orderBy('articles.created_at', 'desc');
                })->findOrFail($id);
        $data = [
            'title' => $profession->name,
            'sub_title' => '',
            'articles' => $profession->articles()->paginate(5),
            'profession_id' => $id
        ];
        return view('blog.list', $data);
    }

    public function subject($id, $slug = NULL) {
        $subject = Subject::whereHas('articles', function ($query) {
                    $query->where('display', 'Y')
                            ->orderBy('articles.created_at', 'desc');
                })->findOrFail($id);
        $data = [
            'title' => $subject->name,
            'sub_title' => '',
            'articles' => $subject->articles()->paginate(5),
            'subject_id' => $id
        ];
        return view('blog.list', $data);
    }

    public function user($id) {
        $user = User::whereHas('articles', function ($query) {
            $query->where('display', 'Y')
                    ->orderBy('articles.created_at', 'desc');
        })->findOrFail($id);

        $data = [
            'title' => $user->name,
            'sub_title' => '',
            'articles' => $user->articles()->paginate(5)
        ];
        return view('blog.list', $data);
    }

    public function tag($id, $slug = NULL)
    {
        $tag = Tag::whereHas('articles', function ($query) {
            $query->where('display', 'Y')
                    ->orderBy('articles.created_at', 'desc');
        })->findOrFail($id);
        $data = [
            'title' => $tag->name,
            'sub_title' => '',
            'articles' => $tag->articles()->paginate(5)
        ];
        return view('blog.list', $data);
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
            $article_id = $request->input('article_id');
            $article = Article::where('display', 'Y')->findOrFail($article_id);
            
            $comment = new Comment();
            $comment->details = $request->input('details');
            
            $article->comments()->save($comment);
            Session::flash('message', 'Comment added!');
            return Redirect::to(URL::previous() . "#comments");
        } catch(Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }
}
