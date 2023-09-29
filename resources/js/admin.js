import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(function () {
    $('select').change(function () {
        var orderId = $(this).data('order-id');
        var newStatus = $(this).val();

        console.log("order:",orderId,"status:",newStatus);
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $.ajax({
            type: 'POST',
            url: '/admin/orders/update',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                _token: csrfToken,
                orderId: orderId,
                newStatus: newStatus
            },
            success: function (response) {
                console.log("success");
            },
            error: function (xhr, status, error) {
                console.log("error:",error);
            }
        });
    });
});
