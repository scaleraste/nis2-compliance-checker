@section('title', __('strings.informations'))

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
                {{ __('strings.informations') }}
            </h2>
        </div>
    </x-slot>


    <div class="py-12" style="margin-top: -50px">
        <div class="max-w-7xl mx-auto lg:px-2">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <main class="mt-6">
                    <main class="mt-6">
                        <div class="grid gap-6 lg:grid-cols-1 lg:gap-8">

                            <!-- primo blocco-->
                            <a href="{{ route('nis2.informations') }}">
                                <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#6366f1] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#6366f1]">
                                    <div id="text-container" class="pt-3 sm:pt-5">
                                        <h1 class="text-xl font-semibold text-black dark:text-white">{{ __('strings.paragrafo-nis2') }}</h1>
                                        <p style="padding-right: 60px" class="mt-4 text-sm/relaxed">
                                            {{ __('strings.descrizione-nis2') }}
                                        </p>
                                    </div>
                                </div>
                            </a>

                            <!-- secondo blocco-->
                            <a href="{{ route('controls.informations') }}">
                                <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#6366f1] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#6366f1]">
                                    <div id="text-container" class="pt-3 sm:pt-5">
                                        <h1 class="text-xl font-semibold text-black dark:text-white">{{ __('strings.paragrafo-controlli') }}</h1>
                                        <p style="padding-right: 60px" class="mt-4 text-sm/relaxed">
                                            {{ __('strings.descrizione-controlli') }}
                                        </p>
                                    </div>
                                </div>
                            </a>


                        </div>
                    </main>
                </main>
            </div>
        </div>
    </div>

</x-app-layout>
