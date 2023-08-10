<?php

namespace App\Http\Livewire\Batiments;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $batiments;

    public function mount()
    {
        $this->batiments = DB::table('anosizato_planet_osm_point_points')->selectRaw('anosizato_planet_osm_point_points.name as name , 
        anosizato_planet_osm_point_points.operator as operator , st_asgeojson(anosizato_planet_osm_point_points.*) as geojson')->orderBy('anosizato_planet_osm_point_points.name')->get();
    }

    public function render()
    {
        return view('livewire.batiments.index');
    }
}
