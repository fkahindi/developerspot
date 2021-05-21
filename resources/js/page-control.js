$("document").ready(function() {
    "use strict";

    /* Monitor browser window size and display normal menu if size is greater than 600px */
    window.onresize = function() {
            if (window.innerWidth < 769) {
                $("#dropdown-menu-btn").show();
                $(".nav-content").hide();
                $("#closebtn").hide();

            } else {
                $(".nav-content").show();
                $("#closebtn").hide();

            }
        }
        /*Drop down menu for mobile devices */
    $("#dropdown-menu-btn").on("click", function() {
        $("#dropdown-menu-btn").hide();
        $("#closebtn").show();
        $(".nav-content").show(100);
    });
    $("#closebtn").on("click", function() {
        $("#closebtn").hide();
        $(".nav-content").hide(100);
        $("#dropdown-menu-btn").show();
    });
    $("#tooltip").mouseenter(function() {
        if ($("#profile-checkbox-control").prop("checked") === true) {
            $(".tooltip-text").hide(200);
        } else {
            $(".tooltip-text").show(200);
        }
    });
    $("#profile-checkbox-control").on("click", function() {
        $(".tooltip-text").hide(200);
    });

});