import $ from 'jquery';
window.$ = window.JQuery = $;

$(document).ready(function () {
    $(".add-to-cart-form").submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var bookId = form.data('book-id');
        var csrfToken = form.find('input[name="_token"]').val();

        $.ajax({
            type: 'POST',
            url: '/carts',
            data: {
                _token: csrfToken,
                book: bookId,
            },
            success: function (data) {
                if(data.error){
                    var errorInfo = `
                    <div class="text-red-500">${data.error}</div>
                    `;

                    $('#error-info-' + bookId).html(errorInfo);

                    setTimeout(function() {
                        $('#error-info-' + bookId).fadeOut(500, function() {
                            $(this).empty();
                        });
                    }, 2000);
                }else if(data.success){
                    var successInfo = `
                    <div class="text-yellow-500">${data.success}</div>
                    `;

                    $('#success-info-' + bookId).html(successInfo);

                    setTimeout(function() {
                        $('#success-info-' + bookId).fadeOut(500, function() {
                            $(this).empty();
                        });
                    }, 2000);
                }
            },
        });
    });
});


$(document).ready(function () {
    $(".add-to-cart-form2").submit(function (e) {
        e.preventDefault();
        var book = $('#book').val();
        var csrfToken = $('#csrf_token').val();

        $.ajax({
            type: 'POST',
            url: '/carts',
            data: {
                _token: csrfToken,
                book: book,
            },
            success: function (data) {
                if (data.error) {
                    var errorInfo = `
                    <div class="text-red-500">${data.error}</div>
                    `;

                    $('#error-info').html(errorInfo);

                    setTimeout(function() {
                        $('#error-info').fadeOut(500, function() {
                            $(this).empty();
                        });
                    }, 2000);
                } else if (data.success) {
                    var successInfo = `
                    <div class="text-yellow-500">${data.success}</div>
                    `;

                    $('#success-info').html(successInfo);

                    setTimeout(function() {
                        $('#success-info').fadeOut(500, function() {
                            $(this).empty();
                        });
                    }, 2000);
                }
            },
        });
    });
});
