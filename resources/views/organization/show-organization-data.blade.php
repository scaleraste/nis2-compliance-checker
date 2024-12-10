@section('title', __('strings.dettagli-organizzazione'))

<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('strings.dettagli-organizzazione') }} #{{ $organization->id }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 columns-2" style="margin-bottom: auto">
                    <li><strong>{{ __('strings.nome-organizzazione') }}:</strong> {{ $organization->name }}</li>
                    <li><strong>{{ __('strings.descrizione') }}:</strong> @if($organization->description != 0){{ $organization->description }}@else {{ __('strings.nessuna') }} @endif</li>
                    <li><strong>{{ __('strings.settore') }}:</strong> {{ __('industry_types.' . $organization->industry_type) }}</li>
                    <li><strong>{{ __('strings.dimensioni') }}:</strong> {{ __('sizes.' . $organization->size) }}</li>
                    <!--<li><strong>{{ __('strings.stato-conformita') }}:</strong> {{ $organization->compliance_status }}</li>-->
                    <li><strong>{{ __('strings.creato-il') }}:</strong> {{ $organization->created_at->addHours(1)->format('d-m-Y H:i') }}</li>
                    <li><strong>{{ __('strings.ultima-modifica') }}:</strong> {{ $organization->updated_at->addHours(1)->format('d-m-Y H:i') }}</li>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
