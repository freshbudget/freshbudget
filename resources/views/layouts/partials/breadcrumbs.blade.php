@unless ($breadcrumbs->isEmpty())
    <div class="text-sm">
        <nav>
            <ol class="flex flex-wrap text-sm text-gray-700">
                @foreach ($breadcrumbs as $breadcrumb)
    
                    @if ($breadcrumb->url)
                        <li>
                            <x-link href="{{ $breadcrumb->url }}" class="hover:underline focus:text-blue-900 focus:underline">
                                {{ $breadcrumb->title }}
                            </x-link>
                        </li>
                    @else
                        <li>
                            {{ $breadcrumb->title }}
                        </li>
                    @endif
    
                    @unless($loop->last)
                        <li class="px-2 text-gray-500">
                            /
                        </li>
                    @endif
    
                @endforeach
            </ol>
        </nav>
    </div>
@endunless
