<x-app-layout>
    @section('title', ' - Ajouter un document')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter un document
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ url('/documents') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="parcours">Parcours :</label>
                        <select name="parcours_id" id="parcours" class="border rounded p-2 w-full">
                            <option value="">Sélectionner un parcours</option>
                            @foreach($parcours as $p)
                                <option value="{{ $p->id }}">{{ $p->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="niveau">Année :</label>
                        <select name="niveau_id" id="niveau" class="border rounded p-2 w-full">
                            <option value="">Sélectionner une année</option>
                            @foreach($annees as $a)
                                <option value="{{ $a->id }}">
                                    {{ $a->nom }} ({{ $a->parcours ? $a->parcours->nom : 'Parcours non défini' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="titre">Titre :</label>
                        <input type="text" name="titre" id="titre" class="border rounded p-2 w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="description">Description :</label>
                        <input type="text" name="description" id="description" class="border rounded p-2 w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="fichier" class="form-label">Fichier</label>
                        <input type="file" class="border rounded p-2 w-full" id="fichier" name="fichier" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" required>
                        @error('fichier')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <p class="text-muted mb-4">⚠ Taille maximale : 2 Mo. Vous pouvez utiliser <a href="https://smallpdf.com/compress-pdf#r=compress" style="color: #007bff; text-decoration: underline;" target="_blank">ce site</a> pour compresser vos documents.</p>


                    <button type="submit" class="bg-blue-500 text-white px-12 py-3 rounded">
                        Ajouter
                    </button>

                    <button>
                        <a href="{{ route('documents.index') }}" class="bg-gray-500 text-white px-12 py-3 rounded">Annuler</a>
                    </button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
