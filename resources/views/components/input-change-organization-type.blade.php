@props(['disabled' => false, 'value' => ''])

@php
    $types = __('industry_types');
@endphp

<select id="industry_type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="industry_type" required>
    <option value="" disabled {{ old('industry_type', $value) == '' ? 'selected' : '' }}>{{ __('strings.seleziona_settore') }}</option>
    @foreach($types as $key => $label)
        <option value="{{ $key }}" {{ old('industry_type', $value) == $key ? 'selected' : '' }}>{{ $label }}</option>
    @endforeach
</select>
