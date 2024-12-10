@section('title', __('strings.dashboard'))

<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('strings.area_utente') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto lg:px-2">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <main class="mt-6">
                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                            <!-- primo blocco-->
                            <a href="{{ route('my-organizations.index') }}">
                                <div class="flex items-center gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#6366f1] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#6366f1]">
                                    <div style="margin-top: -20px" class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#6366f1]/10 sm:size-16">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1D4ED8" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                        </svg>
                                    </div>

                                    <div class="px-2 py-5">
                                        <h1 class="text-xl font-semibold text-black dark:text-white">{{ __('strings.gestione-organizzazione') }}</h1>

                                        <p style="padding-right: 60px" class="mt-4 text-sm/relaxed">
                                            {{ __('strings.frase-gestione-organizzazione') }}
                                        </p>
                                    </div>
                                </div>
                            </a>

                            <!-- secondo blocco
                            <a href="{{ route('my-controls.index') }}">
                                <div class="flex items-center gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#1D4ED8] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#1D4ED8]">
                                    <div style="margin-top: -20px" class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#1D4ED8]/10 sm:size-16">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1D4ED8" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                    </div>

                                    <div class="px-2 py-5">
                                        <h1 class="text-xl font-semibold text-black dark:text-white">{{ __('strings.gestione-controlli') }}</h1>

                                        <p style="padding-right: 60px" class="mt-4 text-sm/relaxed">
                                            {{ __('strings.frase-gestione-controlli') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                            -->
                        </div>
                    </main>
                </div>
            </div>
        </div>
</x-app-layout>
