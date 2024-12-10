@section('title', __('strings.dettagli-controllo'))

<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('strings.dettagli-controllo') }} #{{ $control->id }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 columns-2" style="margin-bottom: auto">
                    <li><strong>{{ __('strings.framework') }}:</strong> {{ $control->framework }}</li>
                    <li><strong>{{ __('strings.code') }}:</strong> {{ $control->code }}</li>
                    <li><strong>{{ __('strings.priority') }}:</strong> @if($control->priority != 0) {{ __('priorities.' . $control->priority) }} @endif</li>
                    <li><strong>{{ __('strings.category') }}:</strong> {{ __($control->category) }}</li>
                    <li><strong>{{ __('strings.sub_category') }}:</strong> {{ $control->sub_category }}</li>
                    <li><strong>{{ __('strings.description') }}:</strong> {{ __($control->description) }}</li>
                    <li><strong>{{ __('strings.function') }}:</strong> {{ $control->function }}</li>
                    <li><strong>{{ __('strings.asset_type') }}:</strong> {{ $control->asset_type }}</li>
                    <li><strong>{{ __('strings.creato-il') }}:</strong> {{ $control->created_at->addHours(2)->format('d-m-Y H:i') }}</li>
                    <li><strong>{{ __('strings.ultima-modifica') }}:</strong> {{ $control->updated_at->addHours(2)->format('d-m-Y H:i') }}</li>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
