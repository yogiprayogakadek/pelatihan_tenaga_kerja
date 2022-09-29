function getData() {
    $.ajax({
        type: "get",
        url: "/class/render",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

function getDataParticipant() {
    $.ajax({
        type: "get",
        url: "/class/render/participant",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

function getDataAttendance(class_id) {
    $.ajax({
        type: "get",
        url: "/class/render/attendance/"+class_id,
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
            let length = $('.attendance').length;
            $('.colspan').attr('colspan', length);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

function createAttendance(class_id, meeting_number) {
    $.ajax({
        type: "get",
        url: "/class/render/create-attendance/"+class_id+'/'+meeting_number,
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
        url: "/class/create",
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
        getDataParticipant();
    });

    $('body').on('click', '.btn-attendance', function () {
        let class_id = $(this).data('id');
        getDataAttendance(class_id);
        setTimeout(() => {
            let length = $('.attendance').length;
            $('.colspan').attr('colspan', length);
            $('.btn-create-attendance').attr('data-id', class_id);
        }, 1000)
    });

    $('body').on('click', '.btn-create-attendance', function () {
        let class_id = $(this).data('id');
        let meeting_number = $(this).data('meeting-number');
        createAttendance(class_id, meeting_number);
        setTimeout(() => {
            $('.btn-attendance').attr('data-id', class_id);
            $('input[name=class_id]').val(class_id);
            $('input[name=meeting_number]').val(meeting_number);
        }, 1000)
    });

    // on save button
    $('body').on('click', '.btn-save', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#formAdd')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "/class/store",
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
            url: "/class/edit/" + id,
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
            url: "/class/update",
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

    $('body').on('click', '.btn-delete', function () {
        let id = $(this).data('id')
        Swal.fire({
            title: 'Are you sure?',
            text: "Deleted data cannot be recovered!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "get",
                    url: "/admin/main/delete/" + id,
                    dataType: "json",
                    success: function (response) {
                        $(".render").html(response.data);
                        getData();
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        );
                    },
                    error: function (error) {
                        console.log("Error", error);
                    },
                });
            }
        })
    });

    $('body').on('click', '.btn-process-attendance', function(){
        let class_id = $('#class_id').val();
        let meeting_number = $('#meeting_number').val();
        let length = $('.attendance').length;
        let participant = [];
        let attendance = [];
        Swal.fire({
            title: 'Process attendance?',
            text: "Attendance will be process",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, process it!'
        }).then((result) => {
            if (result.value) {
                for(let i = 1; i <= (length/2); i++) {
                    attendance[i] = $('input[name=attendance_'+i+']:checked').attr('value');
                    participant[i] = $('input[name=attendance_'+i+']:checked').data('participant');
                }
                let form = $('#formAttendance')[0]
                let data = new FormData(form)
                data.append('attendance', attendance)
                data.append('participant', participant)
                data.append('class_id', class_id)
                data.append('meeting_number', meeting_number)
                $.ajax({
                    type: "POST",
                    url: "/class/process-attendance",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function () {
                        $('.btn-process-attendance').attr('disable', 'disabled')
                        $('.btn-process-attendance').html('<i class="fa fa-spin fa-spinner"></i>')
                    },
                    complete: function () {
                        $('.btn-process-attendance').removeAttr('disable')
                        $('.btn-process-attendance').html('Save')
                    },
                    success: function (response) {
                        console.log(response)
                        // $('#form').trigger('reset')
                        // $(".invalid-feedback").html('')
                        getDataAttendance(class_id)
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        );
                    },
                    error: function (error) {
                        console.log("Error", error);
                    }
                });
            }
        })
    });

    $('body').on('click', '.btn-edit-attendance', function() {
        let class_id = $(this).data('class-id');
        let meeting_number = $(this).data('meeting-number');

        createAttendance(class_id, meeting_number);
        setTimeout(() => {
            $('.btn-attendance').attr('data-id', class_id);
            $('input[name=class_id]').val(class_id);
            $('input[name=meeting_number]').val(meeting_number);
            $('.attendance-title').text('Update Attendance for Meeting ' + meeting_number)
        }, 1000)
    });
});