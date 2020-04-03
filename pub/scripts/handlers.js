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
            if (json.status === 'Success') {
                alert(json.status + ': ' + json.message)
            } else {
                alert(json.status + ': ' + json.message)
            }
        }
    });
    return false;
}

function changeLikeHandler(elem) {
    let val = elem.nextElementSibling.textContent.valueOf(),
        photoId = elem.id.slice(5);

    elem.classList.toggle("fa-heart-o");
    elem.classList.toggle("fa-heart");

    if (elem.classList.contains("fa-heart")) {
        elem.nextElementSibling.textContent = parseInt(val) + 1;
        ajax(`/action/like/`, `photoId=${photoId}&action=like`)
    } else {
        elem.nextElementSibling.textContent = String(parseInt(val) - 1);
        ajax(`/action/dislike/`, `photoId=${photoId}&action=dislike`)
    }
}