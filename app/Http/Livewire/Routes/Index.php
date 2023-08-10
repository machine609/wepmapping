<?php

namespace App\Http\Livewire\Routes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $routes;

    public function mount()
    {
        $this->routes = DB::table('anosizato_planet_osm_line_lines')->orderBy('name')->get();
    }
    public function render()
    {
        return view('livewire.routes.index');
    }
}
