function ajaxFormData(relativeUrl, formId, onLoadEnd) {
    let request = new XMLHttpRequest();
    let formData = new FormData(document.getElementById(formId));

    request.open('POST', getHostname() + relativeUrl);
    request.responseType = 'json';
    request.onloadend = function() { onLoadEnd(request.response) };
    request.send(formData)
}

function ajax(relativeUrl, params, onLoadEnd) {
    let request = new XMLHttpRequest();

    request.open('POST', getHostname() + relativeUrl);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.responseType = 'json';
    request.onloadend = function() { onLoadEnd(request.response) };
    request.send(params)
}

function getHostname() {
    return 'http://' + window.location.hostname;
}


function submitFormHandler(action, formId) {
    ajaxFormData(action, formId, (json) => {
        if (json != null) {
            if (json.url != null) {
                window.location.href = json.url
            } else if (json.status === 'success') {
                document.forms[formId].submit()
            } else {
                alert(json.status + ': ' + json.message)
            }
        } else {
            alert('[handlers.js] Error: json is null or undefined');
        }
    });

    return false;
}

function resetHandler() {
    return submitFormHandler('/account/reset-password-change', 'resetForm');
}