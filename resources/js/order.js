import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(function () {
    $('.mark-as-done-button').click(function (e) {
        var orderId = $(this).data('order-id');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var $orderStatusDiv = $(this).closest('.flex').find('.w-28');
        var btnDone = $(this).closest('.flex').find('.mark-as-done-button');
        $.ajax({
            type: 'POST',
            url: '/orders/status',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                _token: csrfToken,
                orderId: orderId,
            },
            success: function (response) {
                btnDone.remove();
                $orderStatusDiv.text('shipped');
            },
            error: function (xhr, status, error) {
            }
        });
    });
});
