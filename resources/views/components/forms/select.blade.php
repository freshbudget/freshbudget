<select {{ $attributes->merge(['class' => 'block w-full transition duration-75 border-gray-300 rounded-lg focus:outline-none ring-green-500 focus:border-gray-300 focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-green-400 focus:bg-gray-50 select-none accent-slate-300']) }}>{{ $slot }}</select>