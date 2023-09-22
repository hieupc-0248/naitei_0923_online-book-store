import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(function() {
    $('#btn-add-update-review').click(function(e) {
        e.preventDefault();
        var csrfToken = $('#csrf_token').val();
        var book = $('#book').val();
        var content = $('#content').val();
        var rating = $('#rating').val();

        $.ajax({
            type: 'POST',
            url: '/store-reviews',
            data: {
                _token: csrfToken,
                book: book,
                content: content,
                rating: rating,
            },
            success: function(data) {
                $('#content').val('');
                $('#error-info').empty();

                var ratingHtml = '';
                for (var i = 1; i <= data.review.rating; i++) {
                    ratingHtml += '<svg class="w-4 h-4 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20"><path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"></path></svg>';
                }

                var remainingStars = 5 - data.review.rating;

                for (var j = 1; j <= remainingStars; j++) {
                    ratingHtml += '<svg class="w-4 h-4 text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m11.479 1.712 2.367 4.8a.532.532 0 0 0 .4.292l5.294.769a.534.534 0 0 1 .3.91l-3.83 3.735a.534.534 0 0 0-.154.473l.9 5.272a.535.535 0 0 1-.775.563l-4.734-2.49a.536.536 0 0 0-.5 0l-4.73 2.487a.534.534 0 0 1-.775-.563l.9-5.272a.534.534 0 0 0-.154-.473L2.158 8.48a.534.534 0 0 1 .3-.911l5.294-.77a.532.532 0 0 0 .4-.292l2.367-4.8a.534.534 0 0 1 .96.004Z"></path></svg>';
                }

                var dateObject = new Date(data.review.created_at);

                var year = dateObject.getFullYear();
                var month = (dateObject.getMonth() + 1).toString().padStart(2, "0");
                var day = dateObject.getDate().toString().padStart(2, "0");
                var hours = dateObject.getHours().toString().padStart(2, "0");
                var minutes = dateObject.getMinutes().toString().padStart(2, "0");
                var seconds = dateObject.getSeconds().toString().padStart(2, "0");

                var formattedDate = year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;

                var newReviewHtml = `
                    <div class="flex flex-col ml-5 mt-4 pb-4 h-40 border-t-4 border-gray-500">
                        <div class="flex items-center">
                            <img class="w-12 h-12 rounded-full" src="../../public/storage/user1.jpg" alt="">
                            <label class="ml-4 text-xl will-change-transformtext-lg font-bold">${data.user.last_name} ${data.user.first_name}</label>
                        </div>
                        <p class="pl-16">${formattedDate}</p>
                        <div class="pl-16 mb-2 flex">
                            ${ratingHtml}
                        </div>
                        <p name="content" class="w-full pl-16">
                            ${data.review.content}
                        </p>
                    </div>`;
                $('#review-list').append(newReviewHtml);
            },
            error: function(error) {
                $('#error-info').empty();
                var errorInfo = `
                    <div class="text-red-500">
                    ${error.responseJSON.errors.content}
                    </div>
                `;
                $('#error-info').append(errorInfo);
            }
        });
    });
});
