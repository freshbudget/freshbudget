@unless ($breadcrumbs->isEmpty())
    <div class="mb-1 text-sm">
        <nav>
            <ol class="flex flex-wrap text-sm text-gray-700">
                @foreach ($breadcrumbs as $breadcrumb)
    
                    @if ($breadcrumb->url)
                        <li>
                            <a href="{{ $breadcrumb->url }}" class="hover:underline focus:text-blue-900 focus:underline">
                                {{ $breadcrumb->title }}
                            </a>
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
