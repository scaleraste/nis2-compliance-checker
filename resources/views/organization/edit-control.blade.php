@section('title', __('strings.modifica_controllo'))

<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('strings.modifica_controllo') }} #{{ $control->id }}
        </h1>
    </x-slot>

    <form method="POST" action="{{ route('control.update', $control->id) }}">
        @csrf
        @method('PUT')

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" style="margin-bottom: auto">
                        <div class="grid grid-cols-2 gap-4 justify-start">

                            <!-- Riferimento NIS2 -->
                            <div>
                                <x-input-label for="nis2_ref" :value="__('strings.riferimento_nis2')" />
                                <x-text-input id="nis2_ref" class="block mt-1 w-full" type="number" name="nis2_ref" min="1" max="17" value="{{ old('nis2_ref', $control->nis2_ref) }}" required autofocus autocomplete="nis2_ref" />
                                <x-input-error :messages="$errors->get('text')" class="mt-2" />
                            </div>

                            <!-- Framework -->
                            <div>
                                <x-input-label for="framework" :value="__('strings.framework')" />
                                <x-text-input id="framework" class="block mt-1 w-full" type="text" name="framework" value="{{ old('framework', $control->framework) }}" required autofocus autocomplete="framework" />
                                <x-input-error :messages="$errors->get('text')" class="mt-2" />
                            </div>

                            <!-- Code -->
                            <div>
                                <x-input-label for="code" :value="__('strings.code')" />
                                <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" value="{{ old('code', $control->code) }}" required autofocus autocomplete="code" />
                                <x-input-error :messages="$errors->get('code')" class="mt-2" />
                            </div>

                            <!-- Priority -->
                            <div>
                                <x-input-label for="priority" :value="__('strings.priority')" />
                                <x-text-input id="priority" class="block mt-1 w-full" type="text" name="priority" value="{{ old('priority', $control->priority) }}" required autofocus autocomplete="priority" />
                                <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                            </div>

                            <!-- Category -->
                            <div>
                                <x-input-label for="category" :value="__('strings.category')" />
                                <x-text-input id="category" class="block mt-1 w-full" type="text" name="category" value="{{ old('category', $control->category) }}" required autofocus autocomplete="category" />
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>

                            <!-- Subcategory -->
                            <div>
                                <x-input-label for="sub_category" :value="__('strings.sub_category')" />
                                <x-text-input id="sub_category" class="block mt-1 w-full" type="text" name="sub_category" value="{{ old('sub_category', $control->sub_category) }}" autofocus autocomplete="sub_category" />
                                <x-input-error :messages="$errors->get('sub_category')" class="mt-2" />
                            </div>

                            <!-- Descrizione -->
                            <div>
                                <x-input-label for="description" :value="__('strings.descrizione')" />
                                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{ old('description', $control->description) }}" required autofocus autocomplete="description" />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <!-- Funzione -->
                            <div>
                                <x-input-label for="function" :value="__('strings.function')" />
                                <x-text-input id="function" class="block mt-1 w-full" type="text" name="function" value="{{ old('function', $control->function) }}" autofocus autocomplete="function" />
                                <x-input-error :messages="$errors->get('function')" class="mt-2" />
                            </div>

                            <!-- Tipo di asset -->
                            <div>
                                <x-input-label for="asset_type" :value="__('strings.asset_type')" />
                                <x-text-input id="asset_type" class="block mt-1 w-full" type="text" name="asset_type" value="{{ old('asset_type', $control->asset_type) }}" autofocus autocomplete="asset_type" />
                                <x-input-error :messages="$errors->get('asset_type')" class="mt-2" />
                            </div>

                            <!-- Pulsante per modificare il controllo -->
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ms-4">
                                    {{ __('strings.modifica_controllo') }}
                                </x-primary-button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
