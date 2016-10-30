<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Profession;
use App\Models\Subject;

class TemplateComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    private $subjects;
    private $professions;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        $this->setSubjects();
        $this->setProfessions();
    }
    
    private function setSubjects() {
        $this->subjects = Subject::whereHas('articles', function ($query) {
                    $query->where('display', 'Y');
                })->get();
    }

    private function setProfessions() {
        $this->professions = Profession::whereHas('articles', function ($query) {
                    $query->where('display', 'Y');
                })->withCount(['articles' => function ($query) {
                    $query->where('display', 'Y');
                }])->get();
    }

    protected function getSubjects() {
        return $this->subjects;
    }

    protected function getProfessions() {
        return $this->professions;
    }
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = [
            'subjects' => $this->getSubjects(),
            'professions' => $this->getProfessions()
        ];        
        $view->with($data);
    }
}
