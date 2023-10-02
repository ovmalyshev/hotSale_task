$(document).ready(function () {
    $("form").submit(function (event) {
        $.ajax({
            type: "POST",
            url: "/validate.php",
            data: $(this).serialize(),
            dataType: "json",
            encode: true,
        }).done(function (data) {
            if (!data.success) {
                if ($(".message-block")) {
                    $(".message-block").empty();
                }
                if ($("h2")) {
                    $("h2").empty();
                }
                if (data.errors.email) {
                    $("#email-group").addClass("has-error");
                    $("#email-group").append(
                        "<div class='message-block' style=\"color:red;\">" + data.errors.email + "</div>"
                    );
                }

                if (data.errors.confirmPassword) {
                    $("#confirmPassword-group").addClass("has-error");
                    $("#confirmPassword-group").append(
                        "<div class='message-block' style=\'color:red;\'>" + data.errors.confirmPassword + "</div>"
                    );
                }

                if (data.errors.userExist) {
                    $("h2").empty();
                    $("form").prepend("<h2 style=\'color:red;\'>" + data.errors.userExist + "</h2>");
                }
            } else {
                $("form").html(
                    "<div class='alert alert-success'> New user successfully created </div>"
                );
            }
        });
        event.preventDefault();
    });
});