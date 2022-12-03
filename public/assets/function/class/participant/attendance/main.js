function getData() {
    $.ajax({
        type: "get",
        url: "/class/participant-attendance/render",
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
        url: "/class/participant/attendance/"+class_id,
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

$(document).ready(function () {
    getData();

    $('body').on('click', '.btn-data', function () {
        getData();
    });

    $('body').on('click', '.btn-view-attendance', function () {
        let class_id = $(this).data('id');
        getDataAttendance(class_id);
        setTimeout(() => {
            let length = $('.attendance').length;
            $('.colspan').attr('colspan', length);
            $('.btn-create-attendance').attr('data-id', class_id);
        }, 1000)
    });
});