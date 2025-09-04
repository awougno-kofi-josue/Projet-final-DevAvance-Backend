<x-app-layout>
<!-- Bootstrap CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <x-slot name="header">
        @section('title', ' - Contact')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Contactez-nous
        </h2>
    </x-slot>

    <div class="container py-5">
        <p>Remplissez le formulaire ci-dessous pour nous envoyer un message :</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</x-app-layout>
