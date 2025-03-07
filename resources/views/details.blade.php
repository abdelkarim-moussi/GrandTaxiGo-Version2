<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .star-rating,.rating {
            color: #fbbf24;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Driver Profile Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/4 flex justify-center">
                    <img src="https://via.placeholder.com/150" alt="Driver Photo" class="w-36 h-36 rounded-full object-cover">
                </div>
                <div class="md:w-3/4 mt-4 md:mt-0">
                    <h2 id="driverName" class="text-2xl font-bold text-gray-800">Driver Name</h2>
                    <div class="rating my-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span class="ml-2 text-gray-600">(4.0)</span>
                    </div>
                    <div class="space-y-2 text-gray-600">
                        <p><span class="font-semibold">Experience:</span> <span id="experience">5 years</span></p>
                        <p><span class="font-semibold">Total Rides:</span> <span id="totalRides">1250</span></p>
                        <p><span class="font-semibold">License Number:</span> <span id="licenseNumber">DL123456</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Review Form -->
        <div class="bg-white rounded-lg shadow-md mb-8">
            <div class="border-b px-6 py-4">
                <h4 class="text-xl font-semibold text-gray-800">Leave a Review</h4>
            </div>
            <div class="p-6">
                <form id="reviewForm" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-gray-700 mb-2">Rating</label>
                        <div class="star-rating flex gap-1">
                            <i class="far fa-star cursor-pointer" data-rating="1"></i>
                            <i class="far fa-star cursor-pointer" data-rating="2"></i>
                            <i class="far fa-star cursor-pointer" data-rating="3"></i>
                            <i class="far fa-star cursor-pointer" data-rating="4"></i>
                            <i class="far fa-star cursor-pointer" data-rating="5"></i>
                        </div>
                    </div>
                    <div>
                        <label for="reviewComment" class="block text-gray-700 mb-2">Your Comment</label>
                        <textarea class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                id="reviewComment" rows="3" required></textarea>
                    </div>

                    <button type="submit" 
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                        Submit Review
                    </button>
                </form>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="border-b px-6 py-4">
                <h4 class="text-xl font-semibold text-gray-800">Reviews</h4>
            </div>
            <div class="p-6">
                <div id="reviewsContainer" class="space-y-4">
                    <!-- Sample Review -->
                    <div class="border rounded-lg p-4">
                        <div class="star-rating mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-700 mb-2">Great driver! Very professional and punctual.</p>
                        <small class="text-gray-500">Posted by John Doe - March 1, 2025</small>
                    </div>
                </div>
            </div>
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
                });
            });
        });

        // Handle review form submission
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const comment = document.getElementById('reviewComment').value;
            const rating = document.querySelectorAll('.star-rating .fas').length;
            
            // Add new review to the reviews container
            const reviewsContainer = document.getElementById('reviewsContainer');
            const newReview = document.createElement('div');
            newReview.className = 'border rounded-lg p-4';
            newReview.innerHTML = `
                <div class="star-rating mb-2">
                    ${Array(5).fill(0).map((_, i) => `<i class="${i < rating ? 'fas' : 'far'} fa-star"></i>`).join('')}
                </div>
                <p class="text-gray-700 mb-2">${comment}</p>
                <small class="text-gray-500">Posted just now</small>
            `;
            reviewsContainer.insertBefore(newReview, reviewsContainer.firstChild);
            
            // Reset form
            this.reset();
            document.querySelectorAll('.star-rating .fa-star').forEach(s => {
                s.classList.remove('fas');
                s.classList.add('far');
            });
        });
    </script>
</body>
</html>
