<footer class="bg-gray-800 text-gray-300 py-6 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
        <p class="text-sm">&copy; {{ date('Y') }} Archive Faculté. Tous droits réservés.</p>
        <div class="flex space-x-4 mt-2 md:mt-0">
            <a href="{{ route('apropos') }}" class="hover:text-white text-sm">À propos</a>
            <a href="{{ route('contact') }}" class="hover:text-white text-sm">Contact</a>
            <a href="#" class="hover:text-white text-sm">Mentions légales</a>
            <a href="mailto:josueawougno@gmail.com?subject=Demande d'information&body=Bonjour," class="hover:text-white text-sm">Email de l'administrateur</a>
            {{-- Numero de telephone --}}
            <a href="tel:+228 93947171" class="hover:text-white text-sm">Numéro de téléphone</a>
        </div>


    </div>
</footer>
