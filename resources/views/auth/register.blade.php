<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - PIPYalah</title>
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

    <!-- Register Form -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Créez votre compte
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Ou
                    <a href="login.html" class="font-medium text-yellow-500 hover:text-yellow-600">
                        connectez-vous à votre compte existant
                    </a>
                </p>
            </div>
            <form class="mt-8 space-y-6" action="/register" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="rounded-md shadow-sm space-y-2 "> 
                    <div class="flex gap-2">
                        <div class="w-full">
                            <label for="firstname" class="sr-only">Fist Name</label>
                            <input id="firstname" name="firstname" type="text" required class="appearance-none w-full rounded-none relative block flex-1 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="First Name">
                        </div>
                        <div class="w-full">
                            <label for="lastname" class="sr-only">Last Name</label>
                            <input id="lastname" name="lastname" type="text" required class="appearance-none w-full rounded-none relative block flex-1 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="Last Name">
                        </div>
                    </div>
                    <div>
                        <label for="email" class="sr-only">Adresse email</label>
                        <input id="email" name="email" type="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="Adresse email">
                    </div>
                    <div>
                        <label for="phone" class="sr-only">Numéro de téléphone</label>
                        <input id="phone" name="phone" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="Numéro de téléphone">
                    </div>
                    <div>
                        <label for="photo" class="sr-only">Photo de Profile</label>
                        <input id="photo" name="photo" type="file" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Mot de passe</label>
                        <input id="password" name="password" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="Mot de passe">
                    </div>
                    <div>
                        <label for="password-confirm" class="sr-only">Confirmer le mot de passe</label>
                        <input id="password-confirm" name="password_confirmation" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="Confirmer le mot de passe">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Type de compte</label>
                    <div class="mt-2 space-y-4">
                        <div class="flex items-center">
                            <input id="account-type-passenger" name="account_type" type="radio" class="h-4 w-4 text-yellow-500 focus:ring-yellow-500 border-gray-300" value="passenger" checked>
                            <label for="account-type-passenger" class="ml-3 block text-sm font-medium text-gray-700">
                                Passager
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="account-type-driver" name="account_type" type="radio" class="h-4 w-4 text-yellow-500 focus:ring-yellow-500 border-gray-300" value="driver">
                            <label for="account-type-driver" class="ml-3 block text-sm font-medium text-gray-700">
                                Chauffeur
                            </label>
                        </div>
                    </div>
                </div>

                <div class="hidden" id="lisence">

                    <div>
                        <label for="driver-lisence" class="block mb-2 text-sm font-medium text-gray-700">
                            Permis de Conduit
                        </label>
                        <input id="driver-lisence" name="driver-lisence" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="Permis">
                    </div>
                    <div class="mt-2">
                        <label for="city" class="sr-only">Ville</label>
                        <input id="city" name="city" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 focus:z-10 sm:text-sm" placeholder="ville actuel">
                    </div>
                    
                </div>

                <div class="flex items-center">
                    <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-yellow-500 focus:ring-yellow-500 border-gray-300 rounded">
                    <label for="terms" class="ml-2 block text-sm text-gray-900">
                        J'accepte les <a href="#" class="text-yellow-500 hover:text-yellow-600">conditions d'utilisation</a> et la <a href="#" class="text-yellow-500 hover:text-yellow-600">politique de confidentialité</a>
                    </label>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-yellow-400 group-hover:text-yellow-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        Créer un compte
                    </button>

                    <div class="flex flex-col gap-2 mt-4">
                        <a href="{{ route('google.redirect')}}" class="w-full border rounded-md py-1 px-2 text-center hover:border-blue-600 flex gap-5 items-center justify-center"><img src="{{asset('imgs/google-icon.png')}}" class="w-[30px]" alt="google auth"> continue avec google</a>
                        <a href="{{ route('facebook.redirect')}}" class="w-full border rounded-md py-1 px-2 text-center hover:border-blue-600 flex gap-5 items-center justify-center" ><img src="{{asset('imgs/facebook-icon.png')}}" class="w-[30px]" alt="facebook auth"> continue avec facebook</a>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
</body>
</html>
