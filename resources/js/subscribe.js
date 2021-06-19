$("document").ready(function() {
    "use strict";
    var email_state = false;
    /**
     * Scripts to manage subscription form
     */
    $("#email").on("blur", function() {
        var email = $("#email").val();
        var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/; /* Check if it's valid mail address */
        var illegalChars = /[\(\)<>\,\;\:\\\"\[\]]/; /* Check for illegal characters */
        if (email === "") {
            email_state = false;
            return;
        }
        /* Further email validation */
        if (!emailFilter.test(email)) {
            email_state = false;
            $("#email").parent().removeClass();
            $("#email").parent().addClass("form_error");
            $("#email").siblings("span").text("Please! Enter valid email address");
        } else if (email.match(illegalChars)) {
            email_state = false;
            $("#email").parent().removeClass();
            $("#email").parent().addClass("form_error");
            $("#email").siblings("span").text("Sorry... Email address contains illegal characters");
        } else {
            email_state = true;
            $("#email").parent().removeClass();
            $("#email").parent().addClass("form_success");
            $("#email").siblings("span").text("");
            $(".subscribe_error").text("");
        }
    });

    $("#submit_subscribe").on("click", function(e) {

        var email = $("#email").val();

        e.preventDefault();

        if (email === "") {
            $("#email").parent().removeClass();
            $("#email").parent().addClass("form_error");
            $("#email").siblings("span").text("Please! Enter your email");
            return;
        }
        if (email_state === false) {
            $(".subscribe_error").text("Fix email errors first");
            return;
        } else {
            $.ajax({
                url: "/spexproject/includes/subscribeFormFunctions.php",
                type: "POST",
                data: {
                    "subscribe": 1,
                    "email": email
                },
                success: function(response) {

                    $("#subscribe_response").append(response);

                    $("#email").val("");
                    $(".subscribe_error").text("");
                }
            });
        }
    });
});