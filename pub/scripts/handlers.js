function signUpHandler() {
    ajaxForForm('/account/register', 'signUpForm', (json) => {
        if (json.status === 'success') {
            document.forms['signUpForm'].submit()
        } else {
            alert(json.status + ': ' + json.message)
        }
    });

    return false;
}

function logInHandler() {
    ajaxForForm('/account/login', 'logInForm', (json) => {
        if (json.status === 'success') {
            document.forms['logInForm'].submit()
        } else {
            alert(json.status + ': ' + json.message)
        }
    });

    return false;
}

function forgotHandler() {
    ajaxForForm('/account/forgot', 'forgotForm', (json) => {
        if (json.status === 'success') {
            document.forms['forgotForm'].submit()
        } else {
            alert(json.status + ': ' + json.message)
        }
    });

    return false;
}

function submitFormHandler(action, formId) {
    ajaxForForm(action, formId, (json) => {
        if (json.status === 'success') {
            document.forms[formId].submit()
        } else {
            alert(json.status + ': ' + json.message)
        }
    });

    return false;
}