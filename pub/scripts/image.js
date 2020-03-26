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
    const imageLoader = document.getElementById('imageLoader');
    imageLoader.addEventListener('change', handleImage, false);
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');

    function handleImage(e) {
        const reader = new FileReader();
        reader.onload = (event) => {
            const img = new Image();
            img.onload = () => {
                // canvas.width = img.width;
                // canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
            };
            img.src = event.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);

        document.getElementById('video').style.display = 'none';
        document.getElementById('canvas').style.display = 'block';

    }

// show file name in the input
    document.getElementById('imageLoader').addEventListener('change', function (e) {
        let fileName = document.getElementById('imageLoader').files[0].name;
        let nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName
    });

});