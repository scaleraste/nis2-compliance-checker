@section('title', __('strings.le_mie_organizzazioni'))

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
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('strings.le_mie_organizzazioni') }}
            </h1>
            <a href="{{ route('organization.create') }}" style="margin-top: -5px; margin-bottom: -10px;">
                <x-primary-button>
                    {{ __('strings.crea_una_nuova_organizzazione') }}
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
        <div id="banner" class="max-w-7xl mx-auto bg-[#eff3ff] border border-indigo-400 text-indigo-700 px-4 py-3 rounded relative sm:px-6 lg:px-8 mb-6" role="alert">
            <span class="block sm:inline">{{__('strings.descrizione-gestione-organizzazione')}}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg id="close-button" class="fill-current h-6 w-6 text-indigo-400" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>{{__('strings.chiudi')}}</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    </div>
    @endif


    <div id="organization-container" class="pb-24 max-w-7xl mx-auto sm:px-6 lg:px-8" style="margin-top: 24px">
                    @if($organizations->isEmpty())
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <p class="text-gray-600">{{ __('strings.ancora_nessuna_organizzazione_creata') }}</p>
                        </div>
                    </div>
                    @else
            <form action="{{ route('my-organizations.index') }}" method="GET" class="flex space-x-8">
                <div id="filter-container" class="parent">
                    <x-input-label style="margin-bottom: 10px; margin-left: 5px" for="filter-label" :value="__('strings.filtra_per')" />

                    <!-- Filtra per dimensioni -->
                    <div class="child inline-block-child">
                        <select style="width: 150px" id="size" name="size" class="truncate hover:text-clip border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="" disabled selected>{{ __('strings.dimensioni') }}</option>
                            @foreach($sizes as $size)
                                <option value="{{ $size }}" {{ request('size') == $size ? 'selected' : '' }}>
                                    {{ __('sizes.' . $size) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtra per settore -->
                    <div class="ms-4 child inline-block-child">
                        <select style="width: 150px" id="industry_type" name="industry_type" class="truncate block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="" disabled selected>{{ __('strings.settore') }}</option>
                            @foreach($industry_types as $industry_type)
                                <option value="{{ $industry_type }}" {{ request('industry_type') == $industry_type ? 'selected' : '' }}>
                                    {{ __('industry_types.' . $industry_type) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="ms-4 child inline-block-child">
                        <x-tertiary-button class="ms-4">
                            {{ __('strings.filtra') }}
                        </x-tertiary-button>

                        @if(request('industry_type') || request('size'))
                            <a href="{{ route('my-organizations.index') }}" style="margin-left: 15px" class="inline-flex items-center px-4 py-2 bg-gray-400 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-white focus:bg-gray-400 dark:focus:bg-white active:bg-gray-400 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-400 transition ease-in-out duration-150">
                                {{ __('strings.azzera') }}
                            </a>
                        @endif
                    </div>



                </div>
            </form>

                    <div class="grid grid-cols-2 gap-4 justify-start my-8">
                            @foreach($organizations as $organization)
                                <div id="scheda-organizzazione" class="bg-white tile-button">
                                    <a href="{{ (route('my-organizations.index') . '/' . $organization->id) }}" class="block">
                                        <div class="text-xl font-semibold">{{ $organization->name }}</div>
                                        <div class="text-sm text-gray-600 mt-4 mb-8">
                                            @if($organization->description != 0)<div><strong>{{ __('strings.descrizione') }}:</strong> {{ $organization->description }}</div>@endif
                                            <div><strong>{{ __('strings.settore') }}:</strong> {{ __('industry_types.' . $organization->industry_type) }}</div>
                                            <div><strong>{{ __('strings.dimensioni') }}:</strong> {{ __('sizes.' . $organization->size) }}</div>
                                            <!-- <div><strong>{{ __('strings.stato-conformita') }}:</strong> {{ $organization->compliance_status }}</div> -->
                                        </div>
                                        <div class="flex space-x mt-4">
                                            <a href="{{ (route('my-organizations.index') . '/' . $organization->id . '/' . __('modifica')) }}">
                                                <x-secondary-button>
                                                    <svg class="h-5 w-5 text-gray-400" width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" /></svg>
                                                </x-secondary-button>
                                            </a>
                                            <form action="{{ route('organization.destroy', $organization->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-secondary-button style="margin-left: 10px; margin-right: 10px" type="submit" onclick="return confirm('{{ __('strings.sei-sicuro-di-eliminare-organizzazione') }}')">
                                                    <svg class="h-5 w-5 text-gray-400"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="3 6 5 6 21 6" />  <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />  <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" /></svg>
                                                </x-secondary-button>
                                            </form>
                                            <div class="flex-grow"></div>
                                            <div class="flex space-x">

                                                <div class="flex space-x">
                                                    <a href="{{ (route('my-organizations.index') . '/' . $organization->id . '/esegui-test-nis2') }}">
                                                        <x-primary-button id="esegui-test-button" style="margin-right: 10px">
                                                            {{ __('strings.esegui') }}
                                                        </x-primary-button>
                                                    </a>


                                                @php
                                                    $hasCompletedTests = $organization->results()->exists();
                                                @endphp

                                                @if ($hasCompletedTests)
                                                    <a href="{{ route('organizations.results.list', $organization->id) }}">
                                                        <x-secondary-button id="results-button">
                                                            {{ __('strings.risultati') }}
                                                        </x-secondary-button>
                                                    </a>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                    </div>
                    @endif
                </div>
</x-app-layout>
