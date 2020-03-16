function ajax(relativeUrl, params, onLoaded) {
    let request = new XMLHttpRequest();
    request.open('POST', getHostname() + relativeUrl);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.responseType = 'json';
    request.onloadend = function() { onLoaded(request.response) };
    request.send(params)
}

function getHostname() {
    return 'http://' + window.location.hostname;
}

function getFormHandler() {
    // document.addEventListener("DOMContentLoaded", function(event) {
    //
    //     switch (document.querySelector("form").name) {
    //         case 'register':
    //             document.querySelector("form").addEventListener("submit", signUpHandler);
    //             break;
    //         case 'login':
    //             document.querySelector("form").addEventListener("submit", loginHandler);
    //             break;
    //         case 'forgot':
    //             document.querySelector("form").addEventListener("submit", forgotHandler);
    //             break;
    //     }
    // });
}