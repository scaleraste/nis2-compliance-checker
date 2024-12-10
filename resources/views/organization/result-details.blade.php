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

    <!-- Punteggio test -->
    <div class="pb-24 max-w-7xl mx-auto sm:px-6 lg:px-8" style="margin-top: 24px">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div id="resultsContainer">
                    @if($score)
                        <div>
                            <div>
                                <h2 class="text-lg font-bold">{{ __('strings.risultato-del-test') }}</h2>
                                <p>{{ __('strings.hai-completato-test-con-punteggio-di') }}: <strong>
                                        @if($score->score >= 100)100%
                                        @else
                                            {{ round($score->score, 2) }}%@endif</strong></p>

                                <p>
                                    {{ __('strings.valutazione') }}:
                                    @if ($score->score >= 0 && $score->score < 100)
                                        <span class="text-red-500 font-bold">{{ __('strings.non-conforme') }}</span>
                                    @elseif ($score->score > 80 && $score->score = 100)
                                        <span class="text-blue-500 font-bold">{{ __('strings.conforme') }}</span>
                                    @else
                                        <span class="text-gray-500">{{ __('Non valido') }}</span>
                                    @endif
                                </p>

                            </div>
                        </div>
                    @else
                        <p>{{ __('strings.punteggio_non_disponibile') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Implementazioni mancanti -->
    @if ($groupedImplementations->filter(fn($_, $key) => explode('|', $key)[3] === 'no')->isNotEmpty())
        <div class="pb-24 max-w-7xl mx-auto sm:px-6 lg:px-8" style="margin-top: -48px">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-100-300">
                    <div class="mt-2">
                        <h2 style="margin-bottom: 30px" class="text-xl font-semibold">{{ __('strings.implementazioni-mancanti') }}:</h2>
                        @foreach ($groupedImplementations as $key => $implementations)
                            @php
                                [$controlId, $code, $framework, $response] = explode('|', $key);
                            @endphp
                            @if($response === 'no')
                                <div id="missing-controls" x-data="{ open: false }" class="border border-red-300 rounded-lg hover:rounded-lg overflow-hidden shadow-sm mt-4">
                                    <h3>
                                        <button type="button" @click="open = !open" class="text-red-600 px-6 py-4 flex items-center justify-between w-full font-medium text-gray-500 hover:bg-gray-100 gap-3">
                                            <span class="font-semibold">{{ $implementations->first()->category }} <strong style="color: lightgrey; font-size: small; font-weight: bold; margin-left: 5px"> {{ $code }} ({{ $framework }})</strong></span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                                </svg>
                                        </button>
                                    </h3>
                                    <div x-show="open" class="px-4 py-2 border-t border-red-300">
                                        <div class="list-disc list-inside text-gray-500">
                                            @foreach ($implementations as $implementation)
                                                <li class="py-1" style="font-size: small">{{ $implementation->implementation_text }}</li>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Implementazioni parziali -->
    @if ($groupedImplementations->filter(fn($_, $key) => explode('|', $key)[3] === 'partially')->isNotEmpty())
        <div class="pb-24 max-w-7xl mx-auto sm:px-6 lg:px-8" style="margin-top: -48px">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-300">
                    <div class="mt-2">
                        <h2 style="margin-bottom: 30px" class="text-xl font-semibold">{{ __('strings.implementazioni-parziali') }}:</h2>
                        @foreach ($groupedImplementations as $key => $implementations)
                            @php
                                [$controlId, $code, $framework, $response] = explode('|', $key);
                            @endphp
                            @if($response === 'partially')
                                <div id="partially-controls" x-data="{ open: false }" class="border border-gray-300 rounded-lg hover:rounded-lg overflow-hidden shadow-sm mt-4">
                                    <h3>
                                        <button type="button" @click="open = !open" class="px-6 text-gray-300 py-4 flex items-center justify-between w-full font-medium text-gray-500 hover:bg-gray-100 gap-3">
                                            <span class="font-semibold">{{ $implementations->first()->category }} <strong style="color: lightgrey; font-size: small; font-weight: bold; margin-left: 5px"> {{ $code }} ({{ $framework }})</strong></span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </h3>
                                    <div x-show="open" class="px-4 py-2 border-t border-gray-300">
                                        <div class="list-disc list-inside text-gray-500">
                                            @foreach ($implementations as $implementation)
                                                <li class="py-1" style="font-size: small">{{ $implementation->implementation_text }}</li>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Report risposte -->
    <div class="py-12" style="margin-top: -100px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container max-w-7xl">
                @foreach($results as $key => $result)
                    @if ($key === 0 || $result->created_at->format('d-m-Y H:i') !== $results[$key - 1]->created_at->format('d-m-Y H:i'))
                        @if ($key !== 0)
            </div>
            @endif

            <div class="rounded-lg bg-white shadow-sm ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#6366f1] overflow-hidden">
                <h3 style="font-size: 20px;" class="pt-8 px-8 font-semibold text-white text-lg rounded-t-lg bg-indigo-400 flex justify-between items-center">
                    <span>{{ __('strings.risultati-del-test', ['name' => $organization->name]) }}</span>
                </h3>
                <h3 class="pb-6 px-8 font-semibold text-white text-lg bg-indigo-400">
                    <small class="font-thin text-gray-200" style="font-size: 16px">({{ $result->created_at->format('d-m-Y H:i') }})</small>
                </h3>

                @php $counter = 1; @endphp
                @endif

                <div id="responses-table">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <tbody>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="w-full px-6 py-4 font-medium text-gray-500">
                                {{ $result->control->description }}
                            </th>
                            <td class="px-6 py-4">
                                @if($result->response === 'yes') {{ __('strings.yes') }}
                                @elseif($result->response === 'no') {{ __('strings.no') }}
                                @else {{ __('strings.partially') }}
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                @php $counter++; @endphp

                @if ($loop->last || $results[$key + 1]->created_at->format('d-m-Y H:i') !== $result->created_at->format('d-m-Y H:i'))
            </div> <!-- Chiude container -->
            @endif
            @endforeach

                <!-- Paginazione -->
                <div class="mt-4">
                    {{ $results->links() }}
                </div>
            </div>
        </div>


</x-app-layout>
