<x-app-layout>
    @section('title', ' - Messages reçus')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages reçus
        </h2>
    </x-slot>

    <div class="container py-5">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Reçu le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                    <tr>
                        <td>{{ $message->id }}</td>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->message }}</td>
                        <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Supprimer ce message ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Aucun message reçu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $messages->links() }} <!-- Pagination si nécessaire -->
    </div>
</x-app-layout>
