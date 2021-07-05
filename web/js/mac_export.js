"use strict";

$(function () {
    $("#exportToSubnet").click(function (e) {
        e.preventDefault();

        $(".subnet-form-wrapper").fadeIn(600);
    });

    $(".subnet-form-wrapper form").submit(function (e) {
        e.preventDefault();

        $.ajax({
            method: "post",
            url: "/mac/exportSubnet/",
            data: $(this).serialize(),
            success: function (response) {
                console.log("success response: ", response);
            },
            error: function (response, param) {
                console.log("error response: ", response);
                console.log("error param: ", param);
            }
        })
    });
});
