function convertCanvasToImage(canvas) {
    const image = new Image();
    image.src = canvas.toDataURL("image/png");
    return image;
}

// TODO: make adding .js on page if needed only

let maskFilename = '';
let maskImg = new Image();

window.addEventListener("DOMContentLoaded", () => {

    // Grab elements, create settings, etc.
    let video = document.getElementById('video'),
        canvas = document.getElementById('canvas'),
        context = canvas.getContext('2d'),
        snapBtn = document.getElementById('snap'),
        newSnapBtn = document.getElementById('new-snap'),
        saveSnapBtn = document.getElementById('save-snap'),
        btnsDefault = document.getElementById('buttons-start'),
        btnsTaken = document.getElementById('buttons-taken'),
        imageLoader = document.getElementById('imageLoader'),
        isCaptured = false;

    // Get image from upload
    function handleImage(e) {
        const reader = new FileReader();
        reader.onload = (event) => {
            const img = new Image();
            img.onload = () => { context.drawImage(img, 0, 0); };
            img.src = event.target.result;
        };

        if (e.target.files.length === 0) { return }

        reader.readAsDataURL(e.target.files[0]);

        clearTimeout(drawVideoHandler);
        isCaptured = true;
    }
    imageLoader.addEventListener('change', handleImage, false);

    // Show file name in the input
    imageLoader.addEventListener('change', function (e) {
        if (document.getElementById('imageLoader').files.length === 0) { return }

        let fileName = document.getElementById('imageLoader').files[0].name;
        let nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName
    });

    // Request camera
    navigator.mediaDevices.getUserMedia({ video: true, audio: false })
        .then(function(stream) {
            /* use the stream */
            video.srcObject = stream;
            video.play();
        })
        .catch(function(err) {
            /* handle the error */
            snapBtn.disabled = true;
        });

    let drawVideoHandler;
    video.addEventListener('play', () => {
        draw(video, context, 640, 480);
    }, false);

    function draw(video, context, width, height) {
        context.drawImage(video, 0, 0, width, height);

        if (maskFilename !== '') {
            maskImg.src = '/pub/res/masks/src/'+maskFilename+'.png';
            context.drawImage(maskImg, 0, 0, width, height);
        }

        drawVideoHandler = setTimeout(draw, 1, video, context, width, height)
    }

    // Trigger photo take
    snapBtn.addEventListener('click', () => {
        console.log('snap clicked');

        clearTimeout(drawVideoHandler);
        console.log('stop video');

        if (isCaptured === false) {
            console.log('is not Captured');

            btnsDefault.style.display = 'none';
            btnsTaken.style.display = 'flex';

        } else if (isCaptured === true) {
            console.log('is Captured');

            btnsDefault.style.display = 'none';
            btnsTaken.style.display = 'flex';
        }

    });

    newSnapBtn.addEventListener('click', () => {
        draw(video, context, 640, 480);

        btnsDefault.style.display = 'flex';
        btnsTaken.style.display = 'none';
        isCaptured = false;
    });

    saveSnapBtn.addEventListener('click', () => {
        let imageBase64 = convertCanvasToImage(canvas).src;

        // Process uploading
        ajax('/create/new-upload', `image=${imageBase64}&maskFilename=${maskFilename}`, (json) => {
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
