function getData() {
    $.ajax({
        type: "get",
        url: "/assessment/render",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

function getDataParticipant(class_id) {
    $.ajax({
        type: "get",
        url: "/assessment/render/"+class_id+"/participant",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
            setTimeout(() => {
                $('.btn-assessment').attr('data-training-class', class_id);
            }, 1000)
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

function tambah() {
    $.ajax({
        type: "get",
        url: "/assessment/create",
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

    $('body').on('click', '.btn-participant', function () {
        let class_id = $(this).data('class-id');
        getDataParticipant(class_id);
    });

    $('body').on('click', '.btn-assessment', function() {
        let participant_id = $(this).data('participant-id');
        var training_class = $(this).data('training-class')
        
        $('#modalAssessment').modal('show');
        $('#modalAssessment input[name=participant_id]').val(participant_id);
        $('#modalAssessment input[name=training_class_id]').val(training_class);
        $('#modalAssessment input[name=speaking]').val('');
        $('#modalAssessment input[name=writing]').val('');
    });

    $('body').on('click', '.btn-view-assessment', function() {
        let participant_id = $(this).data('participant-id');
        var training_class = $(this).data('training-class')

        $('#modalAssessment').modal('show');
        $('#modalAssessment input[name=participant_id]').val(participant_id);
        $('#modalAssessment input[name=training_class_id]').val(training_class);

        $.get("/assessment/edit/"+participant_id, function (data) {
            $('#modalAssessment input[name=speaking]').val(data.speaking);
            $('#modalAssessment input[name=writing]').val(data.writing);
        });
    });

    // on save button
    $('body').on('click', '.btn-save', function (e) {
        let training_class = $('input[name=training_class_id]').val();
        let form = $('#formAssessment')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "/assessment/store",
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
                $('#formAssessment').trigger('reset')
                getDataParticipant(training_class)
                $(".invalid-feedback").html('')
                $('body').find('.is-invalid').removeClass('is-invalid')
                $('#modalAssessment').modal('hide');
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
            url: "/assessment/edit/" + id,
            dataType: "json",
            success: function (response) {
                $(".render").html(response.data);
            },
            error: function (error) {
                console.log("Error", error);
            },
        });
    });

    // on update button
    $('body').on('click', '.btn-update', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#formEdit')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "/assessment/update",
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
                $('#formEdit').trigger('reset')
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

                $.each($('#formEdit').serializeArray(), function (i, field) {
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
});