
<div class="container">
    <h1 class="mt-4 mb-3">Create New Post</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <p>Main Section</p>
            <div class="form-group" id="snap-new-photo">
                <video style="background-color: #666" id="video" width="640" height="480" autoplay></video>
                <button id="snap">Snap Photo</button>
                <button id="upload">Upload Photo</button>
            </div>
            <div class="form-group" style="display: none" id="new-photo-taken">
                <canvas id="canvas" width="640" height="480"></canvas>
                <br />
                <button id="new-snap">New</button>
                <button id="save-snap">Save</button>
            </div>


            <script type="text/javascript">
                // Put event listeners into place
                window.addEventListener("DOMContentLoaded", () => {
                    // Grab elements, create settings, etc.
                    const canvas = document.getElementById('canvas');
                    const context = canvas.getContext('2d');
                    const video = document.getElementById('video');
                    const snapButton = document.getElementById('snap');

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
                        document.getElementById('snap-new-photo').style.display = 'none';
                        document.getElementById('new-photo-taken').style.display = 'block';
                    });

                    document.getElementById('new-snap').addEventListener('click', () => {
                        document.getElementById('snap-new-photo').style.display = 'block';
                        document.getElementById('new-photo-taken').style.display = 'none';
                    });

                    document.getElementById('save-snap').addEventListener('click', () => {
                        // save photo
                    });

                }, false);
            </script>


        </div>
        <div class="col-lg-4">
            <p>Side Menu</p>
        </div>
    </div>
</div>