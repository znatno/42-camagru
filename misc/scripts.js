function _ajaxFormData(relativeUrl, formId, onLoadEnd) {
    let _request = new XMLHttpRequest();
    let formData = new FormData(document.getElementById(formId));

    _request.open('POST', getHostname() + relativeUrl);
    _request.responseType = 'json';
    _request.onloadend = function() { onLoadEnd(_request.response) };
    _request.send(formData)
}

function _ajax(relativeUrl, params, onLoadEnd) {
    let _request = new XMLHttpRequest();

    _request.open('POST', getHostname() + relativeUrl);
    _request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    _request.responseType = 'json';
    _request.onloadend = function() { onLoadEnd(_request.response) };
    _request.send(params)
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