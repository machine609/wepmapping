<div class="px-1 py-2">
    <ul class="space-y-2">
        @forelse($routes as $route)
            <li class="flex justify-between">
                <h1 class="capitalize">{{ $route->name }}</h1>
                <h1 class="capitalize">{{ $route->surface }}</h1>
            </li>
        @empty
            <li>Pas de routes</li>
        @endforelse
    </ul>
</div>