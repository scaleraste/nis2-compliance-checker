@section('title', __('strings.risultati-di', ['name' => $organization->name]))

@if(session()->has('success'))
    <p>{{ session()->get('success') }}</p>
@endif

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('strings.risultati-di', ['name' => $organization->name]) }}
        </h1>
    </x-slot>

    <div class="pb-24 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div style="margin-top: 24px" class="rounded-lg bg-white shadow-sm ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#6366f1]">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white">
                    <div id="advicesContainer">
                        <div>
                            @if ($results->isEmpty())
                                <p class="text-gray-500">{{ __('Nessun risultato disponibile.') }}</p>
                            @else
                                <ul class="hover:rounded-lg divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($results as $result)
                                        <li class="px-4 hover:bg-gray-100  flex items-center justify-between py-4">
                                            <span>{{ \Carbon\Carbon::parse($result->date_time)->locale('it')->isoFormat('LL LTS') }}</span>
                                            <!-- <span>{{ __('Risposte:') }} {{ $result->total }}</span> -->
                                            <a href="{{ route('results.details', ['organization' => $organization->id, 'date' => $result->date_time]) }}"
                                               class="text-blue-500 hover:underline">
                                                {{ __('strings.visualizza-dettagli') }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
