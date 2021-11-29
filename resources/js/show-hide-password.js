const form = document.querySelector('form');

form.oninput = (e) => {
    let elem = e.target;
    let data_id = elem.getAttribute('data-id');

    switch (elem.id) {
        case 'password_' + data_id:
            let eye_id = document.getElementById('toggle_view' + data_id);
            applyStyle(data_id, eye_id);
            break;
        default:
            //do nothing
    }
}
form.addEventListener('click', (e) => {
    let target = e.target;
    let data_id = target.getAttribute('data-id');

    switch (target.id) {
        case 'toggle_view' + data_id:
            let password_id = document.getElementById('password_' + data_id);
            let eye_id = document.getElementById("toggle_view" + data_id);
            togglePass(data_id, password_id);
            toogleEye(data_id, eye_id);
            break;
        default:
            //do nothing
    }
});

const applyStyle = (id, tag) => {
    tag.setAttribute('style', 'visibility : visible');
}

const togglePass = (id, pass) => {
    const type = pass.getAttribute('type') === 'password' ? 'text' : 'password';
    pass.setAttribute('type', type);
}

const toogleEye = (id, toogle_view) => {
    return toogle_view.classList.toggle('fa-eye-slash');
}