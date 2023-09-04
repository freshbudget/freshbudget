@props(['help' => false])

<label {{ $attributes->merge(['class' => 'select-none']) }}>{{ $slot }}@if($attributes->has('required'))<span class="ml-1 text-red-400" title="{{ $help }}">*</span>@endif</label>