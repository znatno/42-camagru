function convertCanvasToImage(canvas) {
    const image = new Image();
    image.src = canvas.toDataURL("image/png");
    return image;
}

function convertImageToCanvas(image) {
    const canvas = document.createElement("canvas");
    canvas.width = image.width;
    canvas.height = image.height;
    canvas.getContext("2d").drawImage(image, 0, 0);

    return canvas;
}



// TODO: make adding .js on page if needed only

window.addEventListener("DOMContentLoaded", () => {

    // Grab elements, create settings, etc.
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    const snapBtn = document.getElementById('snap');
    const newSnapBtn = document.getElementById('new-snap');
    const saveSnapBtn = document.getElementById('save-snap');
    const btnsStart = document.getElementById('buttons-start');
    const btnsTaken = document.getElementById('buttons-taken');
    const imageLoader = document.getElementById('imageLoader');

    // Selected mask ID
    let maskId;
    let masks = document.getElementsByClassName('superpose--select-list-label');

    // Get image from upload
    function handleImage(e) {
        const reader = new FileReader();
        reader.onload = (event) => {
            const img = new Image();
            img.onload = () => { context.drawImage(img, 0, 0); };
            img.src = event.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
        video.style.display = 'none';
        canvas.style.display = 'block';
    }
    imageLoader.addEventListener('change', handleImage, false);

    // Show file name in the input
    imageLoader.addEventListener('change', function (e) {
        let fileName = document.getElementById('imageLoader').files[0].name;
        let nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName
    });

    // Request camera
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function(stream) {
            /* use the stream */
            video.srcObject = stream;
            video.play();

        })
        .catch(function(err) {
            /* handle the error */
            snapBtn.disabled = true;
        });

    // Draw mask preview
    function putMaskToCanvas(maskId) {
        let filename;

        switch (maskId) {
            case '1':
                filename = '42';
                break;
            case '2':
                filename = 'anime';
                break;
            case '3':
                filename = 'brazzers';
                break;
            case '4':
                filename = 'covid';
                break;
            case '5':
                filename = 'cowboy';
                break;
            case '6':
                filename = 'gun';
                break;
            case '7':
                filename = 'jesus';
                break;
            case '8':
                filename = 'kitty';
                break;
            case '9':
                filename = 'mask';
                break;
            default:
                return;
        }
        let maskImg = new Image();
        maskImg.src = '/pub/res/masks/src/' + filename + '.png';

        console.log(maskId);
        console.log(maskImg.src);
        context.drawImage(maskImg, 0, 0, 640, 480);
    }

    // Trigger photo take
    snapBtn.addEventListener('click', () => {
        let videoDisplayStyle = window.getComputedStyle(video).display;

        // Get mask ID
        for (let key in masks) {
            if (window.getComputedStyle(masks[key], ':before').transform === 'matrix(1, 0, 0, 1, 0, 0)') {
                maskId = key;
                break;
            }
        }

        if (videoDisplayStyle === 'block') {
            context.drawImage(video, 0, 0, 640, 480);

            // TODO: add mask on canvas
            putMaskToCanvas(maskId);

            video.style.display = 'none';
            canvas.style.display = 'block';
            btnsStart.style.display = 'none';
            btnsTaken.style.display = 'flex';

        } else if (videoDisplayStyle === 'none') {

            // TODO: add mask on canvas
            putMaskToCanvas(maskId);

            btnsStart.style.display = 'none';
            btnsTaken.style.display = 'flex';
        }
    });

    newSnapBtn.addEventListener('click', () => {
        video.style.display = 'block';
        canvas.style.display = 'none';
        btnsStart.style.display = 'flex';
        btnsTaken.style.display = 'none';
    });

    saveSnapBtn.addEventListener('click', () => {
        let imageBase64 = convertCanvasToImage(canvas).src;


        /*
        if (maskId === '0') {
            alert('Error: no mask selected');
            return;
        }
        */

        // TODO: add mask and show it before saving + upload

        // Process uploading
        ajax('/create/new-upload', `image=${imageBase64}&maskId=${maskId}`, (json) => {
            if (json) {
                if (json.status === 'Success') {
                    alert(json.status + ': ' + json.message)
                } else {
                    alert(json.status + ': ' + json.message)
                }
            }
        })

    });

});
