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

function resetHandler() {
    return submitFormHandler('/account/reset-password-change', 'resetForm');
}

function resetPasswordHandler() {
    import('cookie.js');

    let username = "";
    let email = decodeURI(getCookie());
    let secret = "";

    console.log(email);

    ajax('/account/reset-password-change', `username=${username}&email=${email}&secret=${secret}`, (json) => {

    });

    return false;
}

function submitFormHandler(action, formId) {
    ajaxFormData(action, formId, (json) => {
        console.log(action);
        console.log(formId);
        console.log(json);
        if (json != null) {
            if (json.url != null) {
                window.location.href = json.url
            } else if (json.status === 'success') {
                document.forms[formId].submit()
            } else {
                alert(json.status + ': ' + json.message)
            }
        } else {
            alert('no json');
        }
    });

    return false;
}