function convertCanvasToImage(canvas) {
    const image = new Image();
    image.src = canvas.toDataURL("image/png");
    return image;
}

function removeImage(path) {
    if (confirm('Are you sure you want to delete this image?')) {
        ajax('/create/remove/', `path=${path.slice(1)}`, (json) => {
            if (json) {
                alert(json.status + ': ' + json.message);
            }
        })
    } else {
        console.log(path);
    }
}

// Variables that changes onclick() of mask pictures on View
let maskFilename = '',
    maskImg = new Image();

/*
    TODO: Superposable images must be selectable and the button allowing to take the picture should be inactive
          (not clickable) as long as no superposable image has been selected.
*/

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
            snapBtn.disabled = false;
            maskImg.src = '/pub/res/masks/src/'+maskFilename+'.png';
            context.drawImage(maskImg, 0, 0, width, height);
        } else {
            snapBtn.disabled = true;
        }
        drawVideoHandler = setTimeout(draw, 1, src, context, width, height)
    }

    // Get image and filename from upload
    imageLoader.addEventListener('change', handleImage, false);
    function handleImage(e) {
        const reader = new FileReader();
        reader.onload = (event) => {
            const img = new Image();
            img.onload = () => { draw(img, context); };
            img.src = event.target.result;
        };

        if (e.target.files.length === 0) { return }

        clearTimeout(drawVideoHandler);
        isCaptured = true;
        console.log('test');
        snapBtn.removeAttribute('disabled');
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
            video.srcObject = stream;
            video.play();
        })
        .catch(function(err) {
            snapBtn.disabled = true;
            context.fillStyle = "#eee";
            context.fillRect(0, 0, 640, 480);
            context.font = "200 28pt SF Pro Display";
            context.fillStyle = "purple";
            context.textAlign = "center";
            context.fillText("Turn on camera or upload photo", canvas.width/2, canvas.height/2);
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
        if (maskFilename === '') {
            alert('Select mask first');
            return;
        }

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
