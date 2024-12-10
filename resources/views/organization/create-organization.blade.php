@section('title', __('strings.crea_organizzazione'))

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
            <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('strings.crea_organizzazione') }}
            </h1>
    </x-slot>


    <form id="organizationForm" method="POST" action="{{ route('organization.create') }}">
        @csrf

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" style="margin-bottom: auto">
                        <div id="container" class="grid grid-cols-2 gap-4 justify-start">

                            <!-- Nome organizzazione -->
                            <div>
                                <x-input-label for="name" :value="__('strings.nome-organizzazione')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('text')" class="mt-2" />
                            </div>

                            <!-- Descrizione -->
                            <div>
                                <x-input-label for="description" :value="__('strings.descrizione')" />
                                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" placeholder="{{__('strings.facoltativa')}}" autofocus autocomplete="description" />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <!-- Settore -->
                            <div>
                                <x-input-label for="industry_type" :value="__('strings.settore')" />
                                <x-input-select-organization-type list="industry_types" id="industry_type" class="block mt-1 w-full" type="text" name="industry_type" :value="old('industry_type')" required autocomplete="industry_type" />
                                <x-input-error :messages="$errors->get('industry_type')" class="mt-2" />
                            </div>

                            <!-- Numero di dipendenti -->
                            <div>
                                <x-input-label for="size" :value="__('strings.numero-dipendenti')" />
                                <x-input-select-organization-size list="sizes" id="size" class="block mt-1 w-full" type="text" name="size" :value="old('size')" required autocomplete="size" />
                                <x-input-error :messages="$errors->get('size')" class="mt-2" />
                            </div>

                            <!-- Niente -->
                            <div>
                                <x-text-input type="hidden"/>
                            </div>

                            <!-- Pulsante per creare l'organizzazione -->
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button id="create-organization-button" class="ms-4">
                                    {{ __('strings.crea_organizzazione') }}
                                </x-primary-button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </form>
</x-app-layout>




