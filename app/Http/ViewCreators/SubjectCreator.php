<?php

namespace app\Http\ViewCreators;

use Illuminate\View\View;
use App\Models\Subject;

class SubjectCreator
{
    private $subjects;

    public function __construct()
    {
        $this->setSubjects();
    }

    private function setSubjects() {
        $this->subjects = Subject::whereHas('articles', function ($query) {
            $query->where('display', 'Y');
        })->get();
    }

    protected function getSubjects() {
        return $this->subjects;
    }

    public function create(View $view)
    {
        $view->with('subjects', $this->getSubjects());
    }
}