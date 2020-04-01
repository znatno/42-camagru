function convertCanvasToImage(canvas) {
    const image = new Image();
    image.src = canvas.toDataURL("image/png");
    return image;
}

// TODO: make adding .js on page if needed only

// Variables that changes onclick() of mask pictures on View
let maskFilename = '',
    maskImg = new Image();

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
        isCaptured = false,
        drawVideoHandler;

    // Loop for canvas from web camera or uploaded file
    function draw(src, context, width = 640, height = 480) {
        context.drawImage(src, 0, 0, width, height);
        if (maskFilename !== '') {
            maskImg.src = '/pub/res/masks/src/'+maskFilename+'.png';
            context.drawImage(maskImg, 0, 0, width, height);
        }
        drawVideoHandler = setTimeout(draw, 1, src, context, width, height)
    }

    // Get image and filename from upload
    imageLoader.addEventListener('change', handleImage, false);
    function handleImage(e) {
        const reader = new FileReader();
        reader.onload = (event) => {
            const img = new Image();
            img.onload = () => {
                // context.drawImage(img, 0, 0);
                draw(img, context);
            };
            img.src = event.target.result;

        };
        if (e.target.files.length === 0) { return }
        clearTimeout(drawVideoHandler);
        isCaptured = true;
        reader.readAsDataURL(e.target.files[0]);
        if (e.target.files[0].name.length > 15) {
            e.target.nextElementSibling.innerText = e.target.files[0].name.substring(0, 15) + '...'
        } else {
            e.target.nextElementSibling.innerText = e.target.files[0].name;
        }
    }

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

    // Starts loop if user allowed access for camera
    video.addEventListener('play', () => {
        draw(video, context);
    }, false);

    // Trigger photo take
    snapBtn.addEventListener('click', () => {
        clearTimeout(drawVideoHandler);
        if (isCaptured === false) {
            btnsDefault.style.display = 'none';
            btnsTaken.style.display = 'flex';
        } else if (isCaptured === true) {
            btnsDefault.style.display = 'none';
            btnsTaken.style.display = 'flex';
        }
    });

    // Clear canvas and start new
    newSnapBtn.addEventListener('click', () => {
        draw(video, context);
        btnsDefault.style.display = 'flex';
        btnsTaken.style.display = 'none';
        isCaptured = false;
        imageLoader.value = null;
        imageLoader.innerText = 'Upload photo';
    });

    // Save snap to folder and DB
    saveSnapBtn.addEventListener('click', () => {
        let imageBase64 = convertCanvasToImage(canvas).src;

        // Process uploading
        ajax('/create/new-upload', `image=${imageBase64}&maskFilename=${maskFilename}`, (json) => {
            if (json) {
                if (json.status === 'Success') {
                    alert(json.status + ': ' + json.message);
                } else {
                    alert(json.status + ': ' + json.message);
                }
            }
            draw(video, context);
            btnsDefault.style.display = 'flex';
            btnsTaken.style.display = 'none';
            isCaptured = false;
            imageLoader.value = null;
            imageLoader.innerText = 'Upload photo';
        })

    });

});
