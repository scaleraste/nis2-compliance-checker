@section('title', __('strings.esegui-il-test'))

@if(session()->has('success'))
    <p>
        {{ session()->get('success') }}
    </p>
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
        <div style="display: flex; justify-content: space-between;">
            <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('strings.esegui-il-test') }}
            </h1>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" style="margin-bottom: auto">
                    <div class="container">
                        <div style="font-size: 25px; margin-bottom: 25px"><strong>{{ $organization->name }}</strong></div>
                        @if($organization->description)<li style="font-size: 15px"><strong>{{ $organization->description }}</strong></li>@endif
                        <li>{{ __('industry_types.' . $organization->industry_type) }}</li>
                        <li style="color: darkslategrey">{{ __('sizes.' . $organization->size) }}</li>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- NIS2 Article information -->
    <div style="margin-top: -25px" class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" style="margin-bottom: auto">
                    <!-- Progress bar con 17 step -->
                    <div class="flex w-full bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg h-2.5 dark:bg-gray-700">
                        @for ($i = 1; $i <= 17; $i++)
                            <div style="width: calc(100% / 17); {{ $i <= $group ? 'background-color: #2563eb;' : 'background-color: transparent;' }} "></div>
                        @endfor
                    </div>

                    <h1 style="margin: 40px" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                        NIS2 {{ __('strings.articolo') }} {{ $requirement->article }}
                        @if($requirement->paragraph != 0)par. {{ $requirement->paragraph }}@endif
                        @if($requirement->letter != 0)({{ $requirement->letter }})@endif: "{{ $requirement->name }}"
                    </h1>

                    <h1 style="margin: 25px" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center"></h1>

                    <div id="info-bar">
                        <div style="font-size: 14px" id="banner" class="max-w-7xl mx-auto bg-[#eff3ff] border border-indigo-400 text-indigo-700 p-4 rounded relative " role="alert">
                            <span class="block sm:inline text-smaller">"{{ $requirement->description }}".</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3"></span>
                        </div>
                    </div>
                    </h1>
                </div>
            </div>
        </div>
    </div>


    <div id="pulsanti-auto-compilazione" class="max-w-7xl mx-auto sm:px-4 hidden">
        <div class="p-4" style="margin-bottom: auto">
            <div class="mt-4 flex justify-between" style="padding-bottom: 40px">
                <x-secondary-button id="yes-select-button" class="btn btn-primary">{{ __('strings.seleziona-si') }}</x-secondary-button>
                <x-secondary-button id="random-select-button" class="btn btn-primary">{{ __('strings.seleziona-random') }}</x-secondary-button>
                <x-secondary-button id="no-select-button" class="btn btn-primary">{{ __('strings.seleziona-no') }}</x-secondary-button>
            </div>
        </div>
    </div>


    <!-- Visualizzazione dei controlli -->
    <form method="POST" action="{{ route('test.submit', $organization->id) }}">
        @csrf

        <input type="hidden" name="current_group" value="{{ $group }}">
        <input type="hidden" name="action" id="action" value="">

        @if ($controls->isEmpty())
            <div class="text-center p-4">
                <p style="color: darkslategrey;">{{ __('strings.risposte-gia-date') }}</p>
            </div>
        @else
            @php
                $groupedControls = $controls->groupBy('framework');
            @endphp

            <div id="controls-on-center" class="gap-4 justify-start max-w-7xl mx-auto sm:px-6 lg:px-8">
                @foreach($groupedControls as $framework => $frameworkControls)
                    <div id="accordion-{{ Str::slug($framework) }}" class="lg:py-2">
                        @foreach($frameworkControls as $index => $control)
                            <div id="accordion-container-{{ $control->id }}" x-data="{ open: false }" class="mt-2 rounded-lg overflow-hidden shadow-lg">
                                <h3>
                                    <button style="background: {{ $framework == 'NIST' ? '#4c66f3' : ($framework == 'ISO 27001' ? '#4395f3' : '#4cc1f3') }}"
                                            class="text-white overflow-hidden shadow-sm flex items-center justify-between w-full p-5 font-medium rtl:text-right"
                                            :class="{ 'bg-purple-400': openAccordion === {{ $control->id }} }"
                                            type="button" @click="open = !open"
                                            class="px-6 py-4 flex items-center justify-between w-full font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3">
                                        <span style="text-align: left">{{ $index + 1 }}. {{ $control->category }}  <strong style="font-size: 12px; color: ghostwhite; margin-left: 10px">  {{ $control->framework }} ({{ $control->code }}) @if($control->sub_category != 0) - {{ $control->sub_category }} @endif @if($control->priority != 0) - {{__('strings.priority')}}:  {{ __('priorities.' . $control->priority) }} @endif</strong></span></span>

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                        </svg>



                                    </button>
                                </h3>
                                <div x-show="open"
                                     class="bg-white px-6 py-4 border-t border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                    <div class="list-disc list-inside text-gray-500 dark:text-gray-400">
                                        <p class="py-2" style="font-size: medium">{{ $control->description }}</p>
                                        <div class="flex items-center mt-4">
                                            <div class="me-4">
                                                <input id="responses-{{ $control->id }}-yes" type="radio" class="form-check-input w-4 h-4 text-green-400 focus:ring-green-500"
                                                       name="responses[{{ $control->id }}]" value="yes"
                                                       onchange="handleAccordionChange({{ $control->id }}, {{ $control->id + 1 }})" required>
                                                <label for="responses-{{ $control->id }}-yes">{{ __('strings.yes') }}</label>
                                            </div>
                                            <div class="me-4">
                                                <input id="responses-{{ $control->id }}-partially" type="radio" class="form-check-input w-4 h-4 text-gray-500 focus:ring-gray-500"
                                                       name="responses[{{ $control->id }}]" value="partially"
                                                       onchange="handleAccordionChange({{ $control->id }}, {{ $control->id + 1 }})" required>
                                                <label for="responses-{{ $control->id }}-partially">{{ __('strings.partially') }}</label>
                                            </div>
                                            <div class="me-4">
                                                <input id="responses-{{ $control->id }}-no" type="radio" class="form-check-input w-4 h-4 text-red-500 focus:ring-red-500"
                                                       name="responses[{{ $control->id }}]" value="no"
                                                       onchange="handleAccordionChange({{ $control->id }}, {{ $control->id + 1 }})" required>
                                                <label for="responses-{{ $control->id }}-no">{{ __('strings.no') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-4">
            <div class="p-4" style="margin-bottom: auto">


                <div id="pulsanti-navigazione" class="mt-4 flex justify-between" style="padding-bottom: 40px">

                    @if ($group == 1)
                        <a href="nothing"></a>
                    @endif

                    <!-- Pulsante per il gruppo precedente -->
                    @if ($group > 1) <!-- Link per la pagina precedente -->
                    <x-primary-button id="previous-group-btn" type="submit" class="btn btn-primary" onclick="document.getElementById('action').value = 'previous';">
                        <svg style="padding: 5px; margin-right: 5px; margin-left: -5px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        {{ __('strings.indietro') }}
                    </x-primary-button>
                    @endif

                    <!-- Pulsante per il gruppo successivo -->
                    @if ($group < 17)
                        <x-primary-button id="next-group-btn" type="submit" class="btn btn-primary" onclick="document.getElementById('action').value = 'next';">
                            {{ __('strings.avanti') }}
                            <svg style="padding: 5px; margin-left: 5px; margin-right: -5px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>

                        </x-primary-button>
                    @endif

                    <!-- Pulsante per completare il test -->
                    @if ($group == 17)
                        <x-primary-button id="finish-test-button" type="submit" class="btn btn-success" onclick="document.getElementById('action').value = 'finish'; return confirm('{{ __('strings.conferma-termina-test') }}')">
                            {{ __('strings.termina-test') }}
                        </x-primary-button>
                    @endif
                </div>
            </div>
        </div>

    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Funzione che gestisce l'apertura e la chiusura degli accordion
            function handleAccordionChange(currentId, nextId) {
                // Trova l'accordion corrente e successivo
                const currentAccordion = document.getElementById(`accordion-container-${currentId}`);
                const nextAccordion = document.getElementById(`accordion-container-${nextId}`);

                // Chiudi l'accordion corrente (simula il click sul bottone di chiusura)
                if (currentAccordion) {
                    const currentButton = currentAccordion.querySelector('button');
                    currentButton.click();  // Chiude l'accordion corrente
                }

                // Apri l'accordion successivo (simula il click sul bottone di apertura)
                if (nextAccordion) {
                    const nextButton = nextAccordion.querySelector('button');
                    nextButton.click();  // Apre l'accordion successivo
                }
            }

            // Aggiungi un event listener per ogni radio button
            const radioButtons = document.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Estrai l'ID del controllo corrente
                    const controlId = this.name.match(/\d+/)[0]; // Ottieni l'ID del controllo
                    const nextControlId = parseInt(controlId) + 1;  // Calcola l'ID del controllo successivo

                    // Trova gli accordion corrispondenti agli ID
                    const currentAccordion = document.getElementById(`accordion-container-${controlId}`);
                    const nextAccordion = document.getElementById(`accordion-container-${nextControlId}`);

                    // Se il controllo successivo esiste, esegui l'azione di apertura/chiusura
                    if (currentAccordion && nextAccordion) {
                        handleAccordionChange(controlId, nextControlId);
                    }
                });
            });
        });
        document.getElementById('random-select-button').addEventListener('click', function () {
            // Trova tutti i gruppi di radio button
            const radioGroups = [...new Set([...document.querySelectorAll('input[type="radio"]')].map(radio => radio.name))];

            radioGroups.forEach(groupName => {
                // Trova tutti i radio button appartenenti al gruppo
                const radios = document.querySelectorAll(`input[name="${groupName}"]`);
                if (radios.length > 0) {
                    // Seleziona un radio button casualmente
                    const randomIndex = Math.floor(Math.random() * radios.length);
                    radios[randomIndex].click();
                }
            });

        });
        document.getElementById('yes-select-button').addEventListener('click', function () {
            // Trova tutti i gruppi di radio button
            const radioGroups = [...new Set([...document.querySelectorAll('input[type="radio"]')].map(radio => radio.name))];

            radioGroups.forEach(groupName => {
                // Trova il radio button con valore "yes" nel gruppo
                const yesRadio = document.querySelector(`input[name="${groupName}"][value="yes"]`);
                if (yesRadio) {
                    // Seleziona il radio button con valore "yes"
                    yesRadio.click();
                }
            });
        });
        document.getElementById('no-select-button').addEventListener('click', function () {
            // Trova tutti i gruppi di radio button
            const radioGroups = [...new Set([...document.querySelectorAll('input[type="radio"]')].map(radio => radio.name))];

            radioGroups.forEach(groupName => {
                // Trova il radio button con valore "yes" nel gruppo
                const yesRadio = document.querySelector(`input[name="${groupName}"][value="no"]`);
                if (yesRadio) {
                    // Seleziona il radio button con valore "yes"
                    yesRadio.click();
                }
            });
        });

    </script>

</x-app-layout>
