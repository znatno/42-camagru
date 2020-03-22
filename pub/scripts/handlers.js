function signUpHandler() {
    ajaxFormData('/account/register', 'signUpForm', (json) => {
        if (json.status === 'Success') {
            document.forms['signUpForm'].submit()
        } else {
            alert(json.status + ': ' + json.message)
        }
    });

    return false;
}

function logInHandler() {
    ajaxFormData('/account/login', 'logInForm', (json) => {
        if (json.url) {
            window.location.href = json.url
        } else {
            alert(json.status + ': ' + json.message)
        }
    });

    return false;
}

function forgotHandler() {
    ajaxFormData('/account/forgot', 'forgotForm', (json) => {
        if (json.status === 'Success') {
            document.forms['forgotForm'].submit()
        } else {
            alert(json.status + ': ' + json.message)
        }
    });

    return false;
}

function resetPasswordHandler() {

    // todo: check for working and rm comments

    // let email = getCookie('UserEmail');
    // let secret = getCookie('UserSecretResetPass');
    let password = document.forms['resetForm']['password'].value;

    // ajax('/account/reset-password-change', `email=${email}&secret=${secret}&password=${password}`, (json) => {
    ajax('/account/reset-password-change', `password=${password}`, (json) => {
        alert(json.status + ': ' + json.message)
    });

    return false;
}

function editProfileHandler() {
    // let username;
    // let email;
    // let password;
    // let notification;

    // ajax('/account/showProfileSaveChanges',
    //     `username=${username}&email=${email}&password=${password}&notification=${notification}`, (json) => {
    // });

    ajaxFormData('/account/showProfileSaveChanges', 'editProfileForm', (json) => {
        alert(json.status);
    });

}

