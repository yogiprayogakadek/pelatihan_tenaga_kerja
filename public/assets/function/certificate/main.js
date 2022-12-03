function getData() {
    $.ajax({
        type: "get",
        url: "/certificate/render",
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

    $('body').on('click', '.btn-data', function () {
        getData();
    });

    $('body').on('click', '.btn-participant', function () {
        let class_id = $(this).data('class-id');
        getDataParticipant(class_id);
    });
});