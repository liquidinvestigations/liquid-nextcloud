function formHelper() {
    var form = document.getElementById('login');

    if (!form) {
        throw new Error('login form not found')
    }

    if (form.dataset.autologin === 'true') {
        console.log('autologin');
        form.submit();
    } else {
        console.log('here we will set up listeners');
    }
}

document.addEventListener('DOMContentLoaded', formHelper, false);
