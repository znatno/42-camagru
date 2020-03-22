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

    ajaxFormData('/account/profile-save', 'editProfileForm', (json) => {
        if (json) {
            console.log(json);
            if (json.status === 'Success') {
                alert(json.status + ': ' + json.message)
            } else {
                alert(json.status + ': ' + json.message)
            }
        }
    });
    return false;


}
