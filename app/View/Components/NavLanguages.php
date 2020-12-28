<?php

namespace App\View\Components;

use App\Models\Languages;
use Illuminate\View\Component;

class NavLanguages extends Component
{
    public $route;
    public $route_params;
    public $language_id;
    public $languages;

    public function __construct(string $route, array $routeParams = [], int $languageId = null)
    {
        $this->route        = $route;
        $this->route_params = $routeParams;
        $this->language_id  = $languageId;
        $this->languages    = Languages::where('active', '<>', 2);
    }

    public function render()
    {
        return view('components.nav-languages');
    }
}
