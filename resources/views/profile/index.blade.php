<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - PIPYalah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <x-navigation>
        
    </x-navigation>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <!-- Profile Photo -->
            <div class="md:col-span-1">
                <div class="bg-white shadow rounded-lg p-6">
                    <div class="text-center">
                        <img class="h-32 w-32 rounded-full mx-auto" src="{{ asset('storage/'.$user->photo) }}" alt="Photo de profil">
                        <!-- <div class="mt-4">
                            <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-sm">
                                Changer la photo
                            </button>
                        </div> -->
                        <form action="/profile/photo" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="updated-photo" class="bg-gray-200 text-gray-700 px-4 py-1 mr-2 rounded-lg hover:bg-gray-300 transition text-sm">Modifier la Photo</label>
                            <input class="hidden bg-gray-200 text-gray-700 px-4 py-1 mr-2 rounded-lg hover:bg-gray-300 transition text-sm" type="file" name="updated-photo" id="updated-photo">
                            <button type="submit" class="bg-yellow-500 text-white px-4 py-0.5 rounded-lg hover:bg-yellow-600 transition">Enregistrer</button>
                            @csrf
                        </form>
                    </div>
                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <div class="text-center">
                            <h3 class="text-lg font-medium text-gray-900">{{ $user->firstname ." ".$user->lastname }}</h3>
                            <p class="text-sm text-gray-500">Membre depuis {{ $user->created_at }}</p>
                        </div>
                        <div class="mt-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Note moyenne</span>
                                <span class="text-gray-900 font-medium">4.8/5</span>
                            </div>
                            <div class="flex justify-between text-sm mt-3">
                                <span class="text-gray-500">Courses effectuées</span>
                                <span class="text-gray-900 font-medium">127</span>
                            </div>
                            <div class="flex items-center space-x-4 my-2">
                                <span class="text-sm text-gray-600">Status:</span>
                                @if(Auth::user()->account_type == 'driver')
                                <a href="profile/updateDriverStatus/{{ $driver->status }}" class="bg-green-500 text-white capitalize px-4 py-1 rounded-lg hover:bg-green-600 transition">  
                                    {{ $driver->status}}
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-6">Informations personnelles</h3>
                        <form method="POST" action="/profile">
                            @csrf
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="firstname" class="block text-sm font-medium text-gray-700">Prénom</label>
                                    <input type="text" name="firstname" id="firstname" value="{{ $user->firstname }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="lastname" class="block text-sm font-medium text-gray-700">Nom</label>
                                    <input type="text" name="lastname" id="lastname" value="{{ $user->lastname }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                </div>

                                <div class="col-span-6">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                </div>

                                <div class="col-span-6">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Numéro de téléphone</label>
                                    <input type="tel" name="phone" id="phone" value="{{ $user->phone }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                </div>

                                @if(Auth::user()->account_type == 'driver')
                                <div class="col-span-6">
                                    <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                                    <input type="text" name="city" id="city" value="{{ $driver->city }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                </div>
                                @endif
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                                    Enregistrer les modifications
                                </button>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="bg-white shadow rounded-lg mt-6">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-6">Sécurité</h3>
                        <form>
                            <div class="space-y-4">
                                <div>
                                    <label for="current-password" class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                                    <input type="password" name="current-password" id="current-password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                </div>

                                <div>
                                    <label for="new-password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                                    <input type="password" name="new-password" id="new-password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                </div>

                                <div>
                                    <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
                                    <input type="password" name="confirm-password" id="confirm-password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm">
                                </div>
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                                    Changer le mot de passe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
