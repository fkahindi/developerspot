$("document").ready(function() {
    "use strict";

    $("#password_1").on('input', function() {
        applyStyle(1);
    });
    $("#password_2").on('input', function() {
        applyStyle(2);
    });
    $("#password_3").on('input', function() {
        applyStyle(3);
    });

    $("form").on("click", ["#toggle_view1", "#toggle_view2", "#toggle_view3"], function(e) {
        let target = e.target;
        switch (target.id.toLowerCase()) {
            case "toggle_view1":
                var id = $("#toggle_view1").data('id');
                var pass = selectPasswordId(id);
                var type = pass.getAttribute("type");

                toggleView(type, pass);
                toogleEye(id);
                break;
            case "toggle_view2":
                var id = $("#toggle_view2").data('id');
                var pass = selectPasswordId(id);
                var type = pass.getAttribute("type");

                toggleView(type, pass);
                toogleEye(id);
                break;
            case "toggle_view3":
                var id = $("#toggle_view3").data('id');
                var pass = selectPasswordId(id);
                var type = pass.getAttribute("type");

                toggleView(type, pass);
                toogleEye(id);
                break;
            default:
                /* do nothing */
        }
    });

    function toggleView(type, password) {
        let toggleType = type === 'password' ? 'text' : 'password';
        password.setAttribute('type', toggleType);
    }

    function applyStyle(id) {
        $('#toggle_view' + id).attr('style', 'visibility : visible');
    }

    function selectPasswordId(id) {
        return document.getElementById("password_" + id);
    }

    function toogleEye(id) {
        return document.getElementById("toggle_view" + id).classList.toggle('fa-eye-slash');
    }
});