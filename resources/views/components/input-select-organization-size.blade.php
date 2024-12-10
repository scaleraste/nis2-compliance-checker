@props(['disabled' => false])

@php
    $sizes = __('sizes');
@endphp

<select id="size" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="size" required>
    <option value="" selected disabled>{{ __('strings.seleziona_il_numero_dipendenti') }}</option>
    @foreach($sizes as $key => $label)
        <option value="{{ $key }}" {{ old('size') == $key ? 'selected' : '' }}>{{ $label }}</option>
    @endforeach
</select>
