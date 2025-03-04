<nav class="bg-white shadow-lg sticky top-0 w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="text-2xl font-bold text-yellow-500">PIPYalah</div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/" class="text-gray-600 hover:text-yellow-500">Accueil</a>
            
                    @auth
                    @if(Auth::user()->account_type == 'passenger')
                    <a href="/drivers" class="text-gray-600 hover:text-yellow-500">Chauffeurs</a>
                    <a href="/reservations" class="text-gray-600 hover:text-yellow-500">Mes Réservations</a>
                    @endif
                    @if(Auth::user()->account_type == 'driver')
                    <a href="/reservations" class="text-gray-600 hover:text-yellow-500">Demandes</a>
                    @endif

                    @if(Auth::user()->account_type == 'admin')
                    <a href="/admin" class="text-gray-600 hover:text-yellow-500">Dashboard</a>
                    @endif

                    <a href="/profile" class="text-gray-600 hover:text-yellow-500">profil</a>
                    <a href="/logout" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                            logout
                    </a>
                    
                    @endauth
                    @guest
                        <a href="/drivers" class="text-gray-600 hover:text-yellow-500">Chauffeurs</a>
                        <a href="/login" class="text-gray-600 hover:text-yellow-500">Connexion</a>
                        <a href="/register" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                            Inscription
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>