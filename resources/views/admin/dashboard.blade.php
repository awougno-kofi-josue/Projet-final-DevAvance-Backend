<x-app-layout>
    <x-slot name="header">
        @section('title', ' - Tableau de bord Admin')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tableau de bord Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Documents -->
            <a href="{{ route('documents.index') }}" class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition flex flex-col items-center">
                <h3 class="text-lg font-bold mb-2">Documents</h3>
                <p class="text-2xl">{{ $documentsCount }}</p>
                <span class="mt-2 text-blue-500 underline">Gérer</span>
            </a>

            <!-- Parcours -->
            <a href="#" class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition flex flex-col items-center">
                <h3 class="text-lg font-bold mb-2">Parcours</h3>
                <p class="text-2xl">{{ $parcoursCount }}</p>
                <span class="mt-2 text-blue-500 underline">Gérer</span>
            </a>

            <!-- Niveaux (Années) -->
            <a href="#" class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition flex flex-col items-center">
                <h3 class="text-lg font-bold mb-2">Années</h3>
                <p class="text-2xl">{{ $niveauxCount }}</p>
                <span class="mt-2 text-blue-500 underline">Gérer</span>
            </a>

            <!-- Utilisateurs -->
            <a href="#" class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition flex flex-col items-center">
                <h3 class="text-lg font-bold mb-2">Utilisateurs</h3>
                <p class="text-2xl">{{ $usersCount }}</p>
                <span class="mt-2 text-blue-500 underline">Gérer</span>
            </a>
            <!-- Messages -->
            <a href="{{ route('admin.messages.index') }}" class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition flex flex-col items-center">
                <h3 class="text-lg font-bold mb-2">Messages</h3>
                <p class="text-2xl">{{ $messagesCount }}</p>
                <span class="mt-2 text-blue-500 underline">Gérer</span>
            </a>

        </div>
    </div>
</x-app-layout>
