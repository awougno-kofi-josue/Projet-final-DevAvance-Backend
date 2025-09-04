<x-app-layout>
    <x-slot name="header">
        @section('title', ' - Liste des documents')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Liste des documents
        </h2>

        <div>
            <a href="{{ route('documents.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ajouter un document</a>

        </div>
            </x-slot>

    <!-- Formulaire de filtre -->
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 py-6">
        <form method="GET" action="{{ route('documents.index') }}" class="flex flex-wrap gap-4 items-center">
            <!-- Parcours -->
            <select name="parcours_id" class="border rounded px-3 py-2">
                <option value="">Tous les parcours</option>
                @foreach($parcoursList as $parcours)
                    <option value="{{ $parcours->id }}" {{ request('parcours_id') == $parcours->id ? 'selected' : '' }}>
                        {{ $parcours->nom }}
                    </option>
                @endforeach
            </select>

            <!-- Année -->
            <select name="annee_id" class="border rounded px-3 py-2">
                <option value="">Toutes les années</option>
                @foreach($anneesList as $annee)
                    <option value="{{ $annee->id }}" {{ request('annee_id') == $annee->id ? 'selected' : '' }}>
                        {{ $annee->nom }} ({{ $annee->parcours->nom ?? '' }})
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Filtrer
            </button>
        </form>
    </div>

    <!-- Cartes des documents -->
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($documents as $doc)
                <div class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-bold mb-2">{{ $doc->titre }}</h3>
                        <p class="text-gray-600 mb-1"><strong>Parcours :</strong> {{ $doc->parcours ? $doc->parcours->nom : 'N/A' }}</p>
                        <p class="text-gray-600 mb-1"><strong>Année :</strong> {{ $doc->niveau ? $doc->niveau->nom : 'N/A' }}</p>
                        <p class="text-gray-700 mb-2"><strong>Description :</strong> {{ $doc->description }}</p>
                    </div>

                    <!-- Boutons Ouvrir et Télécharger -->
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('documents.view', $doc->id) }}" target="_blank"
                           class="flex items-center justify-center bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Ouvrir
                        </a>

                        <a href="{{ route('documents.download', $doc->id) }}"
                           class="flex items-center justify-center bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12v8m0 0l-4-4m4 4l4-4m0-8V4m0 0l-4 4m4-4l4 4"/>
                            </svg>
                            Télécharger
                        </a>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">Aucun document trouvé.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $documents->links() }}
        </div>
    </div>
</x-app-layout>
