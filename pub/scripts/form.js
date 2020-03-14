
document.addEventListener('DOMContentLoaded', function() {
    //alert('im working1');

    var form = document.querySelector('form');

    //console.log(form);

    form.onsubmit(function (event) {

        event.preventDefault();

        alert('im working2')

    })

});

// todo: rm before variant

$(document).ready(function() {

    $('form').submit(function (event) {

        var json;

        event.preventDefault();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,

            success: function(result) {
                console.log(result);
                json = jQuery.parseJSON(result);

                if (json.url) {
                    window.location.href = json.url;
                } else {
                    alert(json.status + ' - ' + json.message);
                }
            }
        })

    })

});
