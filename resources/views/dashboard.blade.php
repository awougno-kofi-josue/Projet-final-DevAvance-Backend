<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bienvenue, {{ Auth::user()->name }} - Tableau de bord
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold">Voir les documents</h3>
                <p class="mt-2 text-gray-700">Consultez tous les documents auxquels vous avez accès.</p>
                <a href="{{ route('documents.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">Accéder</a>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold">Ajouter certains documents</h3>
                <p class="mt-2 text-gray-700">Pour élargir l'archive, nous vous invitons à ajouter des documents.</p>
                <a href="{{ route('documents.create') }}" class="mt-4 inline-block text-blue-500 hover:underline">Accéder</a>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold">Mon profil</h3>
                <p class="mt-2 text-gray-700">Modifier vos informations personnelles.</p>
                <a href="{{ route('profile.edit') }}" class="mt-4 inline-block text-blue-500 hover:underline">Modifier</a>
            </div>

        </div>
    </div>
</x-app-layout>
