function signUpHandler() {
    ajaxFormData('/account/register', 'signUpForm', (json) => {
        if (json.status === 'success') {
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
        if (json.status === 'success') {
            document.forms['forgotForm'].submit()
        } else {
            alert(json.status + ': ' + json.message)
        }
    });

    return false;
}

function submitFormHandler(action, formId) {
    ajaxFormData(action, formId, (json) => {
        if (json.status === 'success') {
            document.forms[formId].submit()
        } else {
            alert(json.status + ': ' + json.message)
        }
    });

    return false;
}