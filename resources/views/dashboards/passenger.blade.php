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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .star-rating,.rating {
            color: #fbbf24;
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
                    
                    @endif

                    @if($reservation->reservaton_status == "done")
                    <button id="review-btn" onclick="addReview('{{$reservation->driver_id}}','{{$reservation->user_id}}')" class="bg-yellow-500 text-white px-4 py-1 rounded-lg hover:bg-yellow-600 transition">
                        Laisser un avis
                    </button>
                    @endif
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <!-- Review Form -->
    <div class="bg-white rounded-md shadow-md mb-8 hidden absolute top-20 right-20 z-20 w-full max-w-[350px]" id="review-modal">
            <div class="border-b px-4 py-2">
                <h4 class="text-md font-semibold text-gray-800">Laisser un avis</h4>
            </div>
            <div class="p-6">
                <form id="reviewForm" class="space-y-4" action="/review" method="POST">
                    @csrf
                    <div>
                        <label class="block text-gray-700 mb-2">Notation</label>
                        <div class="star-rating flex gap-1">
                            <i class="far fa-star cursor-pointer" data-rating="1"></i>
                            <i class="far fa-star cursor-pointer" data-rating="2"></i>
                            <i class="far fa-star cursor-pointer" data-rating="3"></i>
                            <i class="far fa-star cursor-pointer" data-rating="4"></i>
                            <i class="far fa-star cursor-pointer" data-rating="5"></i>
                        </div>
                    </div>

                    <input id="note" name="note" value="0" type="hidden" min="0" max="5">
                    <input id="driver-id" name="driver-id" value="0" type="hidden" min="0" max="5">
                    <input id="user-id" name="user-id" value="0" type="hidden" min="0" max="5">
                    <div>
                        <label for="reviewComment" class="block text-gray-700 mb-2">Votre Commentaire</label>
                        <textarea name="review-comment" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                id="reviewComment" rows="3" required></textarea>
                    </div>

                    <div class="flex justify-between gap-4">
                            
                        <button type="submit" 
                                class="bg-yellow-600 text-white px-4 py-1 rounded-md hover:bg-yellow-700 transition duration-200">
                            Laisser Avis
                        </button>

                        <button id="annuler-avis-btn" type="button" 
                                class="bg-red-600 text-white px-4 py-1 rounded-md hover:bg-red-700 transition duration-200">
                            annuler
                        </button>
                        
                    </div>
                </form>
            </div>
        </div>



        <script>
        // Star rating functionality
        document.querySelectorAll('.star-rating .fa-star').forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.dataset.rating;
                document.querySelectorAll('.star-rating .fa-star').forEach((s, index) => {
                    if (index < rating) {
                        s.classList.remove('far');
                        s.classList.add('fas');
                    } else {
                        s.classList.remove('fas');
                        s.classList.add('far');
                    }

                    document.getElementById('note').value = rating;
                });
            });
        });

        // Handle review form submission
        // document.getElementById('reviewForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     const comment = document.getElementById('reviewComment').value;
        //     const rating = document.querySelectorAll('.star-rating .fas').length;
            
        //     // Add new review to the reviews container
        //     const reviewsContainer = document.getElementById('reviewsContainer');
        //     const newReview = document.createElement('div');
        //     newReview.className = 'border rounded-lg p-4';
        //     newReview.innerHTML = `
        //         <div class="star-rating mb-2">
        //             ${Array(5).fill(0).map((_, i) => `<i class="${i < rating ? 'fas' : 'far'} fa-star"></i>`).join('')}
        //         </div>
        //         <p class="text-gray-700 mb-2">${comment}</p>
        //         <small class="text-gray-500">Posted just now</small>
        //     `;
        //     // reviewsContainer.insertBefore(newReview, reviewsContainer.firstChild);
            
        //     // Reset form
        //     this.reset();
        //     document.querySelectorAll('.star-rating .fa-star').forEach(s => {
        //         s.classList.remove('fas');
        //         s.classList.add('far');
        //     });
        // });

        document.getElementById('annuler-avis-btn').addEventListener('click',function(){
            document.getElementById('review-modal').classList.add('hidden');
        })

        function addReview(driver_id,user_id){
            document.getElementById('review-modal').classList.remove('hidden');
            document.getElementById('driver-id').value = driver_id;
            document.getElementById('user-id').value = user_id;
        }

    </script>

    <!-- <script src="{{ asset('js/script.js') }}"></script> -->
    
</body>
</html>
