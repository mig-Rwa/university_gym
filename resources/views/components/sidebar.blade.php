<nav class="w-72 min-h-full bg-gray-900 p-8 flex flex-col justify-start">
    <ul class="space-y-6 w-full">
        @foreach($items as $item)
            <li>
                <a href="{{ $item['url'] }}"
                   class="block w-full px-6 py-4 text-lg font-semibold rounded border border-uni-red transition-colors duration-200
                    {{ request()->routeIs($item['active'] ?? '') ? 'bg-uni-red text-white' : 'text-white hover:bg-gray-800 hover:border-white' }}">
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
