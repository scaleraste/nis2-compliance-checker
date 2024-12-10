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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="container">
                            @foreach($results as $key => $result)
                                @if ($key === 0 || $result->created_at->format('d-m-Y H:i') !== $results[$key - 1]->created_at->format('d-m-Y H:i'))
                                    @if ($key !== 0)
                        </div> <!-- Chiude il blocco precedente -->
                        @endif


                    <div class="rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#6366f1] lg:pb-6 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#6366f1]">
                            <h3 style="font-size: 30px;" class=" pt-8 px-16 font-semibold text-white text-lg rounded-t-lg bg-indigo-400 flex justify-between items-center">
                                <span>{{ __('strings.risultati-del-organization', ['title' => $organization->name]) }}</span>
                                <small class="text-white uppercase text-justify"><strong>{{ __('strings.risultati') }}</strong></small>
                            </h3>
                            <h3 class="pb-6 px-16 font-semibold text-white text-lg bg-indigo-400">
                                <small class="font-thin text-gray-200" style="font-size: 16px">({{ $result->created_at->addHours(2)->format('d-m-Y H:i') }})</small>
                            </h3>


                            @php $counter = 1; @endphp
                            @endif

                            <div class="m-10 p-8 rounded-lg bg-white shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#6366f1] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#6366f1]">
                                <div id="question-points" class="flex">
                                    <p class="text-indigo-400 mb-2"><strong>{{ $result->control->description }}</strong></p>
                                </div>
                                <div class="flex">
                                    <p class="text-indigo-400 mb-2"><strong>{{ $result->control->framework }} ({{ $result->control->code }})</strong></p>
                                </div>


                            @if ($result->response === 'yes')
                                            <p><strong>{{ __('strings.yes') }}</strong></p>
                                        @elseif ($result->response === 'no')
                                            <p><strong>{{ __('strings.no') }}</strong></p>
                                        @endif

                                </div>

                            @php $counter++; @endphp

                            @if ($loop->last || $results[$key + 1]->created_at->format('d-m-Y H:i') !== $result->created_at->format('d-m-Y H:i'))
                        </div> <!-- Chiude container -->
            <br>
            <br>
            <br>
                        @endif
                        @endforeach
                    </div>

                </div>

        </div>
    </div>
</x-app-layout>

