let proceedAction = false;

function signUpAjax() {
    ajax('/account/register', `username=${username}&email=${email}&password=${password}`, (json) => {
        console.log('ajax1 ...');
        if (json.url) {
            window.location.href = json.url
        } else {
            console.log('ajax2 ...');
            alert(json.status + ': ' + json.message);
            console.log('ajax3 ...');
        }
    });
}

function signUpHandler() {
    console.log('function ...');

    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    console.log('ajax0 ...');

    signUpAjax();

    console.log('return ...');
    return false;
}

function loginHandler(event) {

    event.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    ajax('/account/login', `username=${username}&password=${password}`, (json) => {
        if (json.url) {
            window.location.href = json.url
        } else {
            alert(json.status + ': ' + json.message)
        }
    });

    return false;
}

function forgotHandler(event) {

    event.preventDefault();

    const email = document.getElementById('email').value;

    ajax('/account/forgot', `email=${email}`, (json) => {
        if (json.url) {
            window.location.href = json.url
        } else {
            alert(json.status + ': ' + json.message)
        }
    });

    return false;
}