const form = document.querySelector('form');

form.oninput = e => {
    /* form input event delegation */
    let elem = e.target;
    let data_id = elem.getAttribute('data-id');

    switch (elem.id) {
        case 'password_' + data_id:
            let eye_id = document.getElementById('toggle_view' + data_id);
            applyStyle(eye_id);
            break;
        default:
            /* do nothing */
    }
}

form.addEventListener('click', (e) => {
    /* form click event delegation */
    let target = e.target;
    let data_id = target.getAttribute('data-id');

    switch (target.id) {
        case 'toggle_view' + data_id:
            let password_id = document.getElementById('password_' + data_id);
            let eye_id = document.getElementById("toggle_view" + data_id);
            togglePass(password_id);
            toogleEye(eye_id);
            break;
        default:
            /* do nothing */
    }
});

const applyStyle = tag => {
    /* set element visibility property */
    tag.setAttribute('style', 'visibility : visible');
}

const togglePass = pass => {
    /* toggle between password and plain text input type */
    const type = pass.getAttribute('type') === 'password' ? 'text' : 'password';
    pass.setAttribute('type', type);
}

const toogleEye = toogle_view => {
    /* toggle between eye and eye-slash */
    return toogle_view.classList.toggle('fa-eye-slash');
}

/* For online server, run the following command on the terminal to get minified, compressed and mangled file:
"terser show-hide-password.js --compress --mangle --output show-hide-password.min.js"
*/