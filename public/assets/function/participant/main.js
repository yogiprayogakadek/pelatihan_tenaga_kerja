function getData() {
    $.ajax({
        type: "get",
        url: "/participant/render",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

function tambah() {
    $.ajax({
        type: "get",
        url: "/participant/create",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

$(document).ready(function () {
    getData();

    $('body').on('click', '.btn-add', function () {
        tambah();
    });

    $('body').on('click', '.btn-data', function () {
        getData();
    });

    // on save button
    $('body').on('click', '.btn-save', function (e) {
        let form = $('#formAdd')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "/participant/store",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $('.btn-save').attr('disable', 'disabled')
                $('.btn-save').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function () {
                $('.btn-save').removeAttr('disable')
                $('.btn-save').html('Save')
            },
            success: function (response) {
                $('#formAdd').trigger('reset')
                $(".invalid-feedback").html('')
                getData();
                Swal.fire(
                    response.title,
                    response.message,
                    response.status
                );
            },
            error: function (error) {
                let formName = []
                let errorName = []

                $.each($('#formAdd').serializeArray(), function (i, field) {
                    formName.push(field.name.replace(/\[|\]/g, ''))
                });
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function (key, value) {
                            errorName.push(key)
                            if($('.'+key).val() == '') {
                                $('.' + key).addClass('is-invalid')
                                $('.error-' + key).html(value)
                            }
                        })
                        $.each(formName, function (i, field) {
                            $.inArray(field, errorName) == -1 ? $('.'+field).removeClass('is-invalid') : $('.'+field).addClass('is-invalid');
                        });
                    }
                }
            }
        });
    });

    $('body').on('click', '.btn-edit', function () {
        let id = $(this).data('id')
        $.ajax({
            type: "get",
            url: "/participant/edit/" + id,
            dataType: "json",
            success: function (response) {
                $(".render").html(response.data);
            },
            error: function (error) {
                console.log("Error", error);
            },
        });
    });

    // UPLOAD DOCUMENT
    $('body').on('click', '.btn-upload', function() {
        let participantId = $(this).data('id');
        let document = $(this).data('document');
        let title = document.replace(/_/g, ' ');
        
        $('#modalUpload').modal('show');

        $('#modalUpload').find('.modal-title').addClass('capitalize')
        $('#modalUpload').find('.modal-title').html('Upload Document ' + title);
        $('input[name="participant_id"]').val(participantId)
        $('input[name="document"]').val(document)
    });

    // process upload
    $('body').on('click', '.process-upload', function (e) {
        let form = $('#formUpload')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "/participant/upload",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $('.process-upload').attr('disable', 'disabled')
                $('.process-upload').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function () {
                $('.process-upload').removeAttr('disable')
                $('.process-upload').html('Save')
            },
            success: function (response) {
                $('#modalUpload').modal('hide');
                Swal.fire(
                    response.title,
                    response.message,
                    response.status
                );

                setTimeout(() => {
                    location.reload();
                }, 500)
            },
            error: function (error) {
                // 
            }
        });
    });

    $('body').on('change', '.status', function() {
        let status = $(this).val();
        if(status == 0) {
            $('.note-group').prop('hidden', false)
            $('.note').removeClass('is-invalid');
            $('.error-status').html('');
            $('.btn-update').show()
            // $('.btn-update').prop('disabled', true)
            $('body').on('keyup', '.note', function() {
                var length = $(this).val().length
                if(length == 0) {
                    $('.note').addClass('is-invalid');
                    $('.error-note').html('mohon untuk mengisi note');
                    $('.btn-update').prop('disabled', true)
                } else {
                    $('.note').removeClass('is-invalid');
                    $('.error-note').html('');
                    $('.btn-update').prop('disabled', false)
                }
            })
        } else if(status == 1) {
            $('.btn-update').prop('disabled', false)
            $('.note-group').prop('hidden', true)
            $('.note').removeClass('is-invalid');
            $('.error-status').html('');
            $('.btn-update').show()
            $('.note').val('')
        } else if(status == 'none') {
            $('.error-status').html('');
            $('.note-group').prop('hidden', true);
            $('.btn-update').prop('disabled', true)
            $('.note').val('')
        }
    })

    // on save button
    $('body').on('click', '.btn-update', function (e) {
        let form = $('#formEdit')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "/participant/update",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $('.btn-update').attr('disable', 'disabled')
                $('.btn-update').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function () {
                $('.btn-update').removeAttr('disable')
                $('.btn-update').html('Save')
            },
            success: function (response) {
                Swal.fire(
                    response.title,
                    response.message,
                    response.status
                );
                getData();
            },
            error: function (error) {
                // 
            }
        });
    });
});