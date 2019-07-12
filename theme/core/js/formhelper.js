function loginAs(user, password) {
    document.getElementById("user").value = user;
    document.getElementById("password").value =  password;
    document.getElementById("login").submit();
}

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

        var uploadsButton = document.getElementById('login-uploads');
        var adminButton = document.getElementById('login-admin')

        [uploadsButton, adminButton].forEach(function(button) {
            console.log('adding event listener for', button);

            button.addEventListener('click', function(event) {
                console.log('click handler for', event.target);
                event.preventDefault();

                var user = event.target.dataset.user;
                var password = event.target.dataset.password;

                loginAs(user, password)
            })
        })
    }
}

document.addEventListener('DOMContentLoaded', formHelper, false);
