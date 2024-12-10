@section('title', __('strings.i-miei-controlli'))

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('strings.i-miei-controlli') }}
            </h2>
            <a href="{{ route('control.create') }}" style="margin-top: -5px; margin-bottom: -10px;">
                <x-primary-button>
                    {{ __('strings.crea-un-nuovo-controllo') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>


    @if(session()->has('success'))
        <div id="info-bar" class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8 animate-fade-in">
            <div id="banner" class="max-w-7xl mx-auto bg-[#edfff7] border border-teal-400 text-teal-700 px-4 py-3 rounded relative sm:px-6 lg:px-8 mb-6" role="alert">
                <span class="block sm:inline">{{ session()->get('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg id="close-button" class="fill-current h-6 w-6 text-teal-400" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>{{__('strings.chiudi')}}</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            </div>
    @else
    <div id="info-bar" class="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div id="banner" class="max-w-7xl mx-auto bg-[#edf4ff] border border-blue-400 text-blue-700 px-4 py-3 rounded relative sm:px-6 lg:px-8 mb-6" role="alert">
                    <span class="block sm:inline">{{__('strings.descrizione-gestione-controlli')}}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg id="close-button" class="fill-current h-6 w-6 text-blue-400" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>{{__('strings.chiudi')}}</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            </div>
    @endif

        <div id="controls-container" class="pb-24 max-w-7xl mx-auto sm:px-6 lg:px-8" style="margin-top: 24px">
                        @if($controls->isEmpty())
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <p class="text-gray-600">{{ __('strings.ancora_nessun_controllo_creato') }}</p>
                                </div>
                            </div>
                        @else

                        <div class="grid grid-cols-2 gap-4 justify-start">
                            @foreach($controls as $control)
                                <div class="bg-white tile-button-blue">
                                    <a href="{{ (route('my-controls.index') . '/' . $control->id) }}" class="block">
                                        <div class="text-lg font-semibold">{{ $control->text }}</div>
                                        <div class="text-sm text-gray-600 mt-2">
                                            <div><strong>{{ __('strings.riferimento_nis2') }}:</strong> {{ $control->nis2_ref }}</div>
                                            <div><strong>{{ __('strings.framework') }}:</strong> {{ $control->framework }}</div>
                                            <div><strong>{{ __('strings.code') }}:</strong> {{ $control->code }}</div>
                                            <div><strong>{{ __('strings.priority') }}:</strong> @if($control->priority != 0) {{ __('priorities.' . $control->priority) }} @endif</div>
                                            <div><strong>{{ __('strings.category') }}:</strong> {{ __($control->category) }}</div>
                                            <div><strong>{{ __('strings.sub_category') }}:</strong> {{ __($control->sub_category) }}</div>
                                            <div><strong>{{ __('strings.description') }}:</strong> {{ $control->description }}</div>
                                            <div><strong>{{ __('strings.function') }}:</strong> {{ $control->function }}</div>
                                            <div><strong>{{ __('strings.asset_type') }}:</strong> {{ $control->asset_type }}</div>
                                        </div>
                                        <div class="flex space-x mt-4">
                                            <a href="{{ (route('my-controls.index') . '/' . $control->id . '/' . 'modifica') }}">
                                                <x-secondary-button>
                                                    <svg class="h-5 w-5 text-gray-400" width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" /></svg>
                                                </x-secondary-button>
                                            </a>
                                            <form action="{{ route('control.destroy', $control->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-secondary-button style="margin-left: 10px;" type="submit" onclick="return confirm('{{ __('strings.sei-sicuro-di-eliminare-controllo') }}')">
                                                    <svg class="h-5 w-5 text-gray-400"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline compliance_status="3 6 5 6 21 6" />  <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />  <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" /></svg>
                                                </x-secondary-button>
                                            </form>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
</x-app-layout>
