@section('title', __('strings.nis2-informations'))

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
                {{ __('strings.nis2-informations') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" style="margin-bottom: auto">
                    <h1 class="text-2xl">
                        <strong>{{ __('strings.descrizione-nis2-0') }}</strong><br><br>
                    </h1>

                    <div class="container1">
                        {{ __('strings.descrizione-nis2-1') }}<br><br>
                        {{ __('strings.descrizione-nis2-2') }}<br><br>
                        {{ __('strings.descrizione-nis2-3') }}
                    </div>
                </div>
            </div>
        </div>
    </div>




</x-app-layout>
