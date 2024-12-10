@props(['id', 'name', 'rows' => 4])

<textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}" {{ $attributes->merge(['class' => 'block mt-1 w-full border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}>{{ $slot ?? old($name) }}</textarea>
