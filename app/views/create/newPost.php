<div class="container">

  <h1 class="mt-5 mb-4">New Post</h1>

  <div class="row">
    <div class="col-lg-8 mb-4">
      <div class="row mb-2">
        <div class="col-lg-12" id="photo-block">
          <video id="video" width="640" height="480" autoplay></video>
          <canvas id="canvas" width="640" height="480"></canvas>
        </div>
      </div>

      <div class="row mb-4" id="buttons-start">
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
      <div class="row mb-4" id="buttons-taken">
        <div class="col-sm-2 pr-0">
          <button type="button" class="btn btn-success btn-md btn-block" id="saveSnap">Save photo </button>
        </div>
        <div class="col-sm-2 pr-0 pl-2">
          <button type="button" class="btn btn-secondary btn-md btn-block" id="newSnap">Take new </button>
        </div>
      </div>

      <hr>

      <h6 class="mt-4">Select mask menu</h6>
      <ul class="superpose--select-list p-0">
        <li class="superpose--select-list-element">
          <input class="superpose--select-list-input" id="superpose-img-0" type="radio" name="superpose-img-select" checked/>
          <label class="superpose--select-list-label" for="superpose-img-0">
            <span class="superpose--select-list-empty">No mask</span>
            <img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" alt="" />
          </label>
        </li>
        <li class="superpose--select-list-element">
          <input class="superpose--select-list-input" id="superpose-img-1" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-1">
            <img src="https://source.unsplash.com/100x100/?people" alt="No image"/>
          </label>
        </li>
        <li class="superpose--select-list-element">
          <input class="superpose--select-list-input" id="superpose-img-2" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-2">
            <img src="https://source.unsplash.com/100x100/?nature" alt="No image"/>
          </label>
        </li>
        <li class="superpose--select-list-element">
          <input class="superpose--select-list-input" id="superpose-img-3" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-3">
            <img src="https://source.unsplash.com/100x100/?technology" alt="No image"/>
          </label>
        </li>
        <li class="superpose--select-list-element">
          <input class="superpose--select-list-input" id="superpose-img-4" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-4">
            <img src="https://source.unsplash.com/100x100/?business" alt="No image"/>
          </label>
        </li>
      </ul>
      <ul class="superpose--select-list p-0">
        <li class="superpose--select-list-element">
          <input class="superpose--select-list-input" id="superpose-img-5" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-5">
            <img src="https://source.unsplash.com/100x100/?tech" alt="No image"/>
          </label>
        </li>
        <li class="superpose--select-list-element">
          <input class="superpose--select-list-input" id="superpose-img-6" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-6">
            <img src="https://source.unsplash.com/100x100/?it" alt="No image"/>
          </label>
        </li>
        <li class="superpose--select-list-element">
          <input class="superpose--select-list-input" id="superpose-img-7" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-7">
            <img src="https://source.unsplash.com/100x100/?office" alt="No image"/>
          </label>
        </li>
        <li class="superpose--select-list-element">
          <input class="superpose--select-list-input" id="superpose-img-8" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-8">
            <img src="https://source.unsplash.com/100x100/?wow" alt="No image"/>
          </label>
        </li>
        <li class="superpose--select-list-element">
          <input class="superpose--select-list-input" id="superpose-img-9" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-9">
            <img src="https://source.unsplash.com/100x100/?sexy" alt="No image"/>
          </label>
        </li>
      </ul>
    </div>

    <div class="col-lg-4">
      <h6>Previous Pictures</h6>


    </div>

  </div>
</div>

<script>

</script>


