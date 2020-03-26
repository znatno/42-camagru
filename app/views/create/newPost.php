
<div class="container">
    <h1 class="mt-4 mb-3">Create New Post</h1>
    <div class="row">

        <div class="col-lg-8 mb-4">

            <p>Main Section</p>
            <div class="row mb-2">
                <div class="col-lg-12">
                    <video style="background-color: #666; display: block" id="video" width="640" height="480" autoplay></video>
                    <canvas style="display: none" id="canvas" width="640" height="480"></canvas>
                </div>
            </div>

            <div class="row" id="buttonsStart">
                <div class="col-sm-2 pr-0">
                    <button type="button" class="btn btn-primary btn-md btn-block" id="snap">Snap photo</button>
                </div>
                <div class="col-sm-4 pr-0 pl-2">
                    <div class="custom-file">
                        <input id="imageLoader" type="file" name="imageLoader" class="custom-file-input" value="Choose file"/>
                        <label for="imageLoader" class="custom-file-label">Upload photo</label>
                    </div>
                </div>
            </div>
            <div style="display: none" class="row" id="buttonsTaken">
                <div class="col-sm-2 pr-0">
                    <button type="button" class="btn btn-success btn-md btn-block" id="saveSnap">Save photo </button>
                </div>
                <div class="col-sm-2 pr-0 pl-2">
                    <button type="button" class="btn btn-secondary btn-md btn-block" id="newSnap">Take new </button>
                </div>
            </div>

        </div>

        <div class="col-lg-4">
            <p>Side Menu</p>
        </div>

        <script type="text/javascript">
            // take photo to canvas
            // Put event listeners into place
            window.addEventListener("DOMContentLoaded", () => {
                // Grab elements, create settings, etc.
                const canvas = document.getElementById('canvas');
                const context = canvas.getContext('2d');
                const video = document.getElementById('video');

                const snapButton = document.getElementById('snap');

                // Request camera
                navigator.getMedia = ( navigator.getUserMedia ||
                    navigator.webkitGetUserMedia ||
                    navigator.mozGetUserMedia ||
                    navigator.msGetUserMedia );
                navigator.getMedia({ video: true },
                    function(stream) {
                        if (navigator.mozGetUserMedia) {
                            video.mozSrcObject = stream
                        }
                        else {
                            video.srcObject = stream
                        }
                        video.play();
                    },
                    function(err) {
                        snapButton.disabled = true;
                    }
                );

                // Trigger photo take
                document.getElementById('snap').addEventListener('click', () => {
                    context.drawImage(video, 0, 0, 640, 480);
                    document.getElementById('video').style.display = 'none';
                    document.getElementById('canvas').style.display = 'block';
                    document.getElementById('buttonsStart').style.display = 'none';
                    document.getElementById('buttonsTaken').style.display = 'flex';
                });
                document.getElementById('newSnap').addEventListener('click', () => {
                    document.getElementById('video').style.display = 'block';
                    document.getElementById('canvas').style.display = 'none';
                    document.getElementById('buttonsStart').style.display = 'flex';
                    document.getElementById('buttonsTaken').style.display = 'none';
                });

                document.getElementById('saveSnap').addEventListener('click', () => {
                    // save photo
                });

            }, false);



        </script>

    </div>
