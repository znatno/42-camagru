function convertCanvasToImage(canvas) {
    let image = new Image();
    image.src = canvas.toDataURL("image/png");
    return image;
}

function convertImageToCanvas(image) {
    let canvas = document.createElement("canvas");
    canvas.width = image.width;
    canvas.height = image.height;
    canvas.getContext("2d").drawImage(image, 0, 0);

    return canvas;
}

window.addEventListener("DOMContentLoaded", () => {
    // ImageLoader: Grab elements, create settings, etc.
    const imageLoader = document.getElementById('imageLoader');
    imageLoader.addEventListener('change', handleImage, false);
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');

    // Camera: Grab elements, create settings, etc.
    const context = canvas.getContext('2d');
    const video = document.getElementById('video');
    const snapButton = document.getElementById('snap');

    // Get image from upload
    function handleImage(e) {
        const reader = new FileReader();
        reader.onload = (event) => {
            const img = new Image();
            img.onload = () => { ctx.drawImage(img, 0, 0); };
            img.src = event.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
        document.getElementById('video').style.display = 'none';
        document.getElementById('canvas').style.display = 'block';
    }

    // Show file name in the input
    document.getElementById('imageLoader').addEventListener('change', function (e) {
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
            snapButton.disabled = true;
        });

    // Trigger photo take
    document.getElementById('snap').addEventListener('click', () => {
        context.drawImage(video, 0, 0, 640, 480);
        document.getElementById('video').style.display = 'none';
        document.getElementById('canvas').style.display = 'block';
        document.getElementById('buttons-start').style.display = 'none';
        document.getElementById('buttons-taken').style.display = 'flex';
    });
    document.getElementById('newSnap').addEventListener('click', () => {
        document.getElementById('video').style.display = 'block';
        document.getElementById('canvas').style.display = 'none';
        document.getElementById('buttons-start').style.display = 'flex';
        document.getElementById('buttons-taken').style.display = 'none';
    });

    document.getElementById('saveSnap').addEventListener('click', () => {
        // save photo
    });

});
