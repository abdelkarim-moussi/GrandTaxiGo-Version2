<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <title>Mes Réservations - PIPYalah</title>
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

    <!-- Reservations List -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">Mes Réservations</h1>
        @if(\Session::has('success'))
        <div class="bg-yellow-300 text-yellow-600 px-2 py-1">{!! \Session::get('success') !!}</div>
        @endif
        <!-- Tabs -->
        <div class="border-b border-gray-200 mb-8">
            <nav class="-mb-px flex space-x-8">
                <a href="#" class="border-yellow-500 text-yellow-500 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-id="encour">
                    En cours
                </a>
                <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Historique
                </a>
            </nav>
        </div>

        <!-- Active Reservations -->
        <div class="space-y-6" id="encour">
            <!-- Reservation Card -->
             @foreach($reservations as $reservation)
             
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-yellow-100 rounded-full p-3">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ $reservation->id.'/'.$reservation->location }} → {{ $reservation->destination }}</h3>
                            <p class="text-sm text-gray-500">{{ $reservation->date }}</p>
                        </div>
                    </div>
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $reservation->reservaton_status }}</span>
                </div>
                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div>
                        
                        <dt class="text-sm font-medium text-gray-500">Chauffeur</dt>
                        <!-- @foreach($drivers as $driver) -->
                        <dd class="mt-1 text-sm text-gray-900">
                            <!-- @if($reservation->driver_id == $driver->id) -->
                            {{ $reservation->driver_id }} 
                            <!-- @endif -->
                        </dd>
                        <!-- @endforeach -->
                    </div>
                    <div>
                        <!-- <dt class="text-sm font-medium text-gray-500">Véhicule</dt>
                        <dd class="mt-1 text-sm text-gray-900">Mercedes - 12345-A-5</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Prix</dt>
                        <dd class="mt-1 text-sm text-gray-900">120 MAD</dd> -->
                    </div>
                </div>
                <div class="mt-6 flex space-x-4">
                    <!-- <button onclick="cancelReservation('{{$reservation->id}}')" class="cancel-reservation bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                        Annuler
                    </button>
                    <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                        Contacter le chauffeur
                    </button> -->
                    @if($reservation->reservaton_status != "canceled")
                    <a href="reservations/{{ $reservation->id }}" class="cancel-reservation bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                        Annuler
                    </a>
                    <!-- <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                        Contacter le chauffeur
                    </button> -->
                    @endif
                </div>
            </div>
            @endforeach

        </div>
    </div>


    <!-- <script src="{{ asset('js/script.js') }}"></script> -->
    
</body>
</html>
