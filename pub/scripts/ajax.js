function ajaxFormData(relativeUrl, formId, onLoadEnd) {
    let request = new XMLHttpRequest();
    let formData = new FormData(document.getElementById(formId));

    request.open('POST', getHostname() + relativeUrl);
    request.responseType = 'json';
    if (onLoadEnd) {
        request.onloadend = () => { onLoadEnd(request.response) };
    }
    request.send(formData);
}

function ajax(relativeUrl, params, onLoadEnd) {
    let request = new XMLHttpRequest();

    request.open('POST', getHostname() + relativeUrl);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.responseType = 'json';
    if (onLoadEnd) {
        request.onloadend = () => { onLoadEnd(request.response) };
    }
    request.send(params);
}

function getHostname() {
    return 'http://' + window.location.hostname;
}
