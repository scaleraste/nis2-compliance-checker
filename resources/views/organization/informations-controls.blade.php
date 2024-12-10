@section('title', __('strings.controls-informations'))

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
                {{ __('strings.controls-informations') }}
            </h2>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" style="margin-bottom: auto">
                    <h1 class="text-2xl">
                        <strong>{{ __('strings.nist') }}</strong><br><br>
                    </h1>

                    <div class="container1" style="margin-top: -10px">
                        {{ __('strings.descrizione-nist') }}<br><br><br>
                    </div>

                    <h1 class="text-2xl">
                        <strong>{{ __('strings.iso') }}</strong><br><br>
                    </h1>

                    <div class="container1" style="margin-top: -10px">
                        {{ __('strings.descrizione-iso') }}<br><br><br>
                    </div>

                    <h1 class="text-2xl">
                        <strong>{{ __('strings.cis') }}</strong><br><br>
                    </h1>

                    <div class="container1" style="margin-top: -10px">
                        {{ __('strings.descrizione-cis') }}<br><br>
                    </div>

                </div>
            </div>
        </div>
    </div>




</x-app-layout>
