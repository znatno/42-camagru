<div class="container">
  <h1 class="mt-5 mb-4">New Post</h1>
  <div class="row">
    <div class="col-lg-8 mb-4">
      <div class="row mb-2">
        <div class="col-lg-12" id="photo-block">
          <video id="video" width="640" height="480" autoplay hidden></video>
          <canvas style="display: block" id="canvas" width="640" height="480"></canvas>
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
          <button type="button" class="btn btn-success btn-md btn-block" id="save-snap">Save photo </button>
        </div>
        <div class="col-sm-2 pr-0 pl-2">
          <button type="button" class="btn btn-secondary btn-md btn-block" id="new-snap">Take new </button>
        </div>
      </div>
      <hr>
      <h6 class="mt-4">Select mask menu</h6>
      <ul class="superpose--select-list p-0">
        <li class="superpose--select-list-element" onclick="maskId = '0'; maskFilename = ''; ">
          <input class="superpose--select-list-input" id="superpose-img-0" type="radio" name="superpose-img-select" checked/>
          <label class="superpose--select-list-label" for="superpose-img-0">
            <span class="superpose--select-list-empty">No mask</span>
            <img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" alt="" />
          </label>
        </li>
        <li class="superpose--select-list-element" onclick=" maskId = '1'; maskFilename = '42'; ">
          <input class="superpose--select-list-input" id="superpose-img-1" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-1">
            <img src="/pub/res/masks/view/42.jpg" alt="No image"/>
          </label>
        </li>
        <li class="superpose--select-list-element" onclick=" maskId = '2'; maskFilename = 'anime'; ">
          <input class="superpose--select-list-input" id="superpose-img-2" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-2">
            <img src="/pub/res/masks/view/anime.jpg" alt="No image"/>
          </label>
        </li>
        <li class="superpose--select-list-element" onclick=" maskId = '3'; maskFilename = 'brazzers'; ">
          <input class="superpose--select-list-input" id="superpose-img-3" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-3">
            <img src="/pub/res/masks/view/brazzers.jpg" alt="No image"/>
          </label>
        </li>
        <li class="superpose--select-list-element" onclick=" maskId = '4'; maskFilename = 'covid'; ">
          <input class="superpose--select-list-input" id="superpose-img-4" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-4">
            <img src="/pub/res/masks/view/covid.jpg" alt="No image"/>
          </label>
        </li>
      </ul>
      <ul class="superpose--select-list p-0">
        <li class="superpose--select-list-element" onclick=" maskId = '5'; maskFilename = 'cowboy'; ">
          <input class="superpose--select-list-input" id="superpose-img-5" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-5">
            <img src="/pub/res/masks/view/cowboy.jpg" alt="No image"/>
          </label>
        </li>
        <li class="superpose--select-list-element" onclick=" maskId = '6'; maskFilename = 'gun'; ">
          <input class="superpose--select-list-input" id="superpose-img-6" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-6">
            <img src="/pub/res/masks/view/gun.jpg" alt="No image"/>
          </label>
        </li>
        <li class="superpose--select-list-element" onclick=" maskId = '7'; maskFilename = 'jesus'; ">
          <input class="superpose--select-list-input" id="superpose-img-7" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-7">
            <img src="/pub/res/masks/view/jesus.jpg" alt="No image"/>
          </label>
        </li>
        <li class="superpose--select-list-element" onclick=" maskId = '8'; maskFilename = 'kitty'">
          <input class="superpose--select-list-input" id="superpose-img-8" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-8">
            <img src="/pub/res/masks/view/kitty.jpg" alt="No image"/>
          </label>
        </li>
        <li class="superpose--select-list-element" onclick=" maskId = '9'; maskFilename = 'mask'">
          <input class="superpose--select-list-input" id="superpose-img-9" type="radio" name="superpose-img-select" />
          <label class="superpose--select-list-label" for="superpose-img-9">
            <img src="/pub/res/masks/view/mask.jpg" alt="No image"/>
          </label>
        </li>
      </ul>
    </div>
    <div class="col-lg-4">
      <h6 class="mb-4">Previous Pictures</h6>
      <div class="col-lg-12 mb-2 prev-taken-img" id="prev-img-1">
        First
      </div>
      <div class="col-lg-12 mb-2 prev-taken-img" id="prev-img-2">
        Second
      </div>
      <div class="col-lg-12 mb-2 prev-taken-img" id="prev-img-3">
        Third
      </div>
    </div>
  </div>
</div>
