<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Profession;

class ProfessionComposer
{

    private $professions;

    public function __construct()
    {
        $this->setProfessions();
    }

    private function setProfessions() {
        $this->professions = Profession::whereHas('articles', function ($query) {
                    $query->where('display', 'Y');
                })->withCount(['articles' => function ($query) {
                    $query->where('display', 'Y');
                }])->get();
    }

    protected function getProfessions() {
        return $this->professions;
    }

    public function compose(View $view)
    {
        $view->with('professions', $this->getProfessions());
    }
}
