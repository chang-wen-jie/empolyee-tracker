<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $employee->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Personeelsgegevens aanpassen') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Wijzig hier de personeelsnaam en/of de activiteitsstatus.") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('users.update', $employee->id) }}" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="id" :value="__('Personeelsnummer')" />
                                <x-text-input id="id" name="id" type="text" class="mt-1 block w-full" :value="old('name', $employee->id)" disabled />
                            </div>

                            <div>
                                <x-input-label for="name" :value="__('Naam')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $employee->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div class="block mt-4">
                                <label for="active" class="inline-flex items-center">
                                    <input id="active" name="active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="active" value="1" {{ $employee->active ? 'checked="checked' : '' }}"/>
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Actief?') }}</span>
                                </label>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Opslaan') }}</x-primary-button>
                            </div>
                            @method('PUT')
                        </form>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Dienst inroosteren') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Geef de start- en einddatum- en tijd van de aankomende dienst op. Ingeroosterde diensten zijn zichtbaar binnen de kalender.") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('users.schedule', $employee->id, 'shift') }}" class="mt-6 space-y-6">
                            @csrf
                            <x-input-label for="start" :value="__('Start dienst')" />
                            <input type="datetime-local" id="start" name="start" min="{{ date('Y-m-d') }}T00:00" max="{{ date('Y-m-d', strtotime('+1 year')) }}T23:59" required>
                            <x-input-error class="mt-2" :messages="$errors->get('start')" />

                            <x-input-label for="end" :value="__('Einde dienst')" />
                            <input type="datetime-local" id="end" name="end" min="{{ date('Y-m-d') }}T00:00" max="{{ date('Y-m-d', strtotime('+1 year')) }}T23:59" required>
                            <x-input-error class="mt-2" :messages="$errors->get('end')" />

                            @if(session()->has('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Inroosteren') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Afwezigheid registreren') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Geef het datumbereik gepaard met de afwezigheidsreden op. Geregistreerde afwezigheden zijn zichtbaar binnen de kalender.") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('users.schedule', $employee->id) }}" class="mt-6 space-y-6">
                            @csrf
                            <x-input-label for="absence" :value="__('Reden')" />
                            <select id="absence" name="absence">
                                <option value="sick">Ziek</option>
                                <option value="leave">Vakantie</option>
                            </select>

                            <x-input-label for="start" :value="__('Van')" />
                            <input type="date" id="start" name="start" min="{{ date('Y-m-d') }}T00:00" max="{{ date('Y-m-d', strtotime('+1 year')) }}T23:59" required>
                            <x-input-error class="mt-2" :messages="$errors->get('start')" />

                            <x-input-label for="end" :value="__('Tot')" />
                            <input type="date" id="end" name="end" min="{{ date('Y-m-d') }}T00:00" max="{{ date('Y-m-d', strtotime('+1 year')) }}T23:59" required>
                            <x-input-error class="mt-2" :messages="$errors->get('end')" />

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Registreren') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
