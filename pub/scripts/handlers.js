function signUpHandler() {
    ajaxFormData('/account/register', 'signUpForm', (json) => {
        if (json.status === 'Success') {
            document.forms['signUpForm'].submit()
        } else {
            showAlert(json.status + ': ' + json.message)
        }
    });
    return false;
}

function logInHandler() {
    ajaxFormData('/account/login-validate', 'logInForm', (json) => {
        if (json.status === 'Success') {
            document.forms['logInForm'].submit();
        } else {
            showAlert(json.message, "Error");
        }
    });
    return false;
}

function forgotHandler() {
    ajaxFormData('/account/forgot', 'forgotForm', (json) => {
        if (json.status === 'Success') {
            document.forms['forgotForm'].submit()
        } else {
            showAlert(json.message, "Error")
        }
    });
    return false;
}

function resetPasswordHandler() {
    ajaxFormData('/account/reset-password-change', 'resetForm', (json) => {
        if (json.status === 'Success') {
            document.forms['resetForm'].submit()
        } else {
            showAlert(json.status + ': ' + json.message)
        }
    });
    return false;
}

function editProfileHandler() {
    ajaxFormData('/account/profile-save', 'editProfileForm', (json) => {
        if (json) {
            if (json.status === 'Success') {
                showAlert(json.message, json.status)
            } else {
                showAlert(json.message, "error")
            }
        }
    });
    return false;
}

function changeLikeHandler(e) {
    let val = e.nextElementSibling.textContent.valueOf(),
        photoId = e.id.slice(5);

    e.classList.toggle("fa-heart-o");
    e.classList.toggle("fa-heart");

    if (e.classList.contains("fa-heart")) {
        e.nextElementSibling.textContent = parseInt(val) + 1;
        ajax(`/action/like/`, `photoId=${photoId}&action=like`)
    } else {
        e.nextElementSibling.textContent = String(parseInt(val) - 1);
        ajax(`/action/dislike/`, `photoId=${photoId}&action=dislike`)
    }
}

function commentHandler(text, photoId) {
    ajax('/action/comment', `text=${text}&photoId=${photoId}`, (json) => {
        if (json.status === 'Success') {
            location.reload();
        } else {
            showAlert(json.status + ': ' + json.message)
        }
    });
    return false;
}

function deleteCommentHandler(photoId, timestamp, username) {
    ajax('/action/delete-comment', `timestamp=${timestamp}&photoId=${photoId}&username=${username}`,
        (json) => {
        if (json.status === 'Success') {
            location.reload();
        } else {
            showAlert(json.status + ': ' + json.message)
        }
    });
}