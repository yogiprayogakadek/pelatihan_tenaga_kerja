$(document).ready(function () {
    function swal_response(result)
    {
        setTimeout(() => {
            Swal.fire(
                result.title,
                result.message,
                result.status
            )
        }, 1000);
    }

    function send_response(response, payment_id)
    {
        $('#json_callback').val(JSON.stringify(response));
        $('#payment_id').val(payment_id);
        $.ajax({
            url: '/payment/update',
            type: 'POST',
            data: {
                json_callback: JSON.stringify(response),
                payment_id: payment_id,
            },
            success: function (result) {
                swal_response(result);
                setTimeout(function() {
                    location.reload();
                }, 1500);
            }
        });
    }

    $('body').on('click', '.btn-payment', function() {
        $.ajax({
            url: '/payment/store',
            type: 'POST',
            success: function (result) {
                if (result.status == 'success') {
                    window.snap.pay(result.snap_token, {
                        onSuccess: function(response) {
                            // location.href = '/order';
                            setTimeout(() => {
                                send_response(response, result.payment_id);
                            }, 1000)
                        },
                        onPending: function(response) {
                            // location.href = '/order';
                            send_response(response, result.payment_id);
                        },
                        onError: function(response) {
                            // location.href = '/order';
                            send_response(response, result.payment_id);
                        },
                        onClose: function(response) {
                            // location.href = '/order';
                            send_response(response, result.payment_id);
                        },
                    });
                }
                // location.reload();
            },
            error: function() {
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong!' })
            }
        });
    });
});