const accountTypes = document.querySelectorAll('input[name = "account_type"]');
const reservationModal = document.getElementById('reservation-modal');
const reserveButtons = document.querySelectorAll('.reserver');

for(const accountType of accountTypes ){
    accountType.addEventListener('change',()=>{
        if(accountType.value === "driver"){
            document.getElementById('lisence').classList.remove('hidden');
        }
        else document.getElementById('lisence').classList.add('hidden');
    })
}

document.getElementById('annuler').addEventListener('click',function(){
    reservationModal.classList.add('hidden');
})

function reserve(driverid){
    reservationModal.classList.remove('hidden');
    document.getElementById('driverid').value = driverid;
}


// document.getElementById('reservation-form').addEventListener('submit',function(e){
//    e.preventDefault();

//    var url = this.getAttribute('action');
//    let formData = new FormData(this);

//    console.log(formData);

//    var xhttp = new XMLHttpRequest();
//   xhttp.open(
//     'POST',
//      url,
//   )
// })



function cancelReservation(reservationId){

    console.log(reservationId)
    $.ajax({
        type:'PUT',
        url: '/reservations'+reservationId,
        data: { reservationId : reservationId },
        success: (response) => {
            alert(response.message);
            location.reload();
        },
    
   });

}

// document.querySelectorAll('.cancel-reservation').forEach(btn => {

//     btn.addEventListener('click',function(){
        

//     })
// });


// document.getElementById("search-form").addEventListener('submit',function(e){

//         e.preventDefault();

//         var cities = document.querySelectorAll('.driver-city');
//         var value = document.getElementById('search-input').value;

//         cities.forEach(city => {
//             //console.log(city.textContent);
//             if(value == city.textContent);
//             var section = document.getElementById("drivers");
//             section.innerHTML = "";
//             section.innerHTML = `
//                 @foreach($drivers as $driver)
//                 <!-- Driver Card -->
//                 @if($driver->city = ${value})
//                 <div class="bg-white rounded-lg shadow-lg overflow-hidden">
//                     <div class="relative">
//                         <img class="w-48 h-48 mx-auto mt-2 object-fit" src="{{ asset('storage/'.$driver->photo)}}" alt="Chauffeur">
//                         <div class="absolute top-4 right-4">
//                             <span class="text-black px-3 py-1 rounded-full text-sm bg-green-50">{{ $driver->status }}</span>
//                         </div>
//                     </div>
//                     <div class="p-6">
//                         <h3 class="text-xl font-semibold text-gray-900">{{ $driver->firstname .' '.$driver->lastname}}</h3>
//                         <div class="driver-city mt-2 flex items-center text-gray-600">
//                             <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
//                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
//                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
//                             </svg>
//                             {{ $driver->city}}
//                         </div>
//                         <div class="mt-4 flex items-center">
//                             <div class="flex items-center">
//                                 <svg class="text-yellow-500 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
//                                     <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
//                                 </svg>
//                                 <span class="ml-2 text-gray-600">4.8 (156 avis)</span>
//                             </div>
//                         </div>
//                         @if($driver->status == "disponible")
//                         <button onclick="reserve('{{ $driver->id }}')"  class="reserver mt-6 w-full bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-600 transition">
//                             Réserver maintenant
//                         </button>
//                         @endif
    
//                         @if($driver->status != "disponible")
//                         <button  class="reserver mt-6 w-full bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-600 transition">
//                             Indisponible maintenant
//                         </button>
//                         @endif
//                     </div>
//                 </div>
//                 @endif
//             @endforeach
//             `;
//         });

// })


$('#reservation-form').submit(function(e) {
    e.preventDefault();
     
    var url = $(this).attr("action");
    let formData = new FormData(this);

    $.ajax({
            type:'POST',
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                alert('Form submitted successfully');
                location.reload();
            },
            error: function(response){
                $('#ajax-form').find(".print-error-msg").find("ul").html('');
                $('#ajax-form').find(".print-error-msg").css('display','block');
                $.each( response.responseJSON.errors, function( key, value ) {
                    $('#ajax-form').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }
       });
    
});
