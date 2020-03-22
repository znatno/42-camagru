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
    ajaxFormData('/account/login-validate', 'logInForm', (json) => {
        if (json.status === 'Success') {
            document.forms['logInForm'].submit();
        } else {
            alert(json.status + ': ' + json.message);
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
    ajaxFormData('/account/reset-password-change', 'resetForm', (json) => {
        if (json.status === 'Success') {
            document.forms['resetForm'].submit()
        } else {
            alert(json.status + ': ' + json.message)
        }
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

