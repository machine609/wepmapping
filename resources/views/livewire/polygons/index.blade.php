<div class="px-1 py-2">
    <ul class="space-y-2">
        @forelse($polygons as $poly)
            <li class="flex justify-between">
                <h1 class="capitalize">{{ $poly->name }}</h1>
                <h1 class="capitalize">{{ $poly->surface }}</h1>
            </li>
        @empty
            <li>Pas de terrains ou maison</li>
        @endforelse
    </ul>
</div>