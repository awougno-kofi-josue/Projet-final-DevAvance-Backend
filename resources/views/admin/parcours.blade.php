<x-app-layout>
    <x-slot name="header">
        <h2>Ajouter un parcours</h2>
    </x-slot>

    <div class="py-6 max-w-md mx-auto">
        <form method="POST" action="{{ route('admin.parcours.store') }}">
            @csrf
            <div class="mb-4">
                <label for="nom">Nom du parcours</label>
                <input type="text" name="nom" id="nom" class="w-full border rounded p-2" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter</button>
        </form>
    </div>
</x-app-layout>
