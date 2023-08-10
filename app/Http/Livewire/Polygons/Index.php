<?php

namespace App\Http\Livewire\Polygons;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $polygons;

    public function mount()
    {
        $this->polygons = DB::table('anosizato_planet_osm_polygon_polygons')->orderBy('name')->get();
    }
    public function render()
    {
        return view('livewire.polygons.index');
    }
}
