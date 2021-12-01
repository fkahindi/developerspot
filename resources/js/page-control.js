$("document").ready(function() {
    "use strict";
    /* Monitor browser window size and display normal menu if size is greater than 600px */
    const header = $('header');
    const menu_btn = $("#dropdown-menu-btn");
    const close_btn = $("#closebtn");
    const nav_content = $(".nav-content");
    const profile_chkbox = $("#profile-checkbox-control");
    const tooltip = $("#tooltip");
    const tooltip_txt = $(".tooltip-text");

    header.on('click', (e) => {
        const target = e.target;
        switch (target.id) {
            case 'dropdown-menu-btn':
                menu_btn.hide();
                close_btn.show();
                nav_content.show(100);
                break;
            case 'closebtn':
                close_btn.hide();
                nav_content.hide(100);
                menu_btn.show();
                break;
            case 'profile-checkbox-control':
                tooltip_txt.hide(200);
                break;
            default:
                /* nothing */
        }
    });
    window.onresize = () => {
            if (window.innerWidth < 769) {
                menu_btn.show();
                nav_content.hide();
                close_btn.hide();

            } else {
                nav_content.show();
                close_btn.hide();

            }
        }
        /*Drop down menu for mobile devices */

    tooltip.mouseenter(() => {
        if (profile_chkbox.prop("checked") === true) {
            tooltip_txt.hide(200);
        } else {
            tooltip_txt.show(200);
        }
    });
});
/* For online server, run the following command on the terminal to get minified, compressed and mangled file:
 "terser page-control.js --compress --mangle --output page-control.min.js"
*/