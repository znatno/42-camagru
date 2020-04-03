<div class="container">
  <h1 class="mt-4 mb-4">Main Page</h1>
  <div class="row">
    <div class="col-lg-8 mb-4 p-0">
		<?php foreach ($photos as $val): ?>
          <div class="col-lg-8 mb-4 post">
            <img src="<?= $val['path'] ?>" alt="Error image" width="240">
            <p class="mt-2">
              <?php if (isset($_SESSION['user'])): ?>
                <i onclick="changeLikeHandler(this)" class="fa <?= $val['liked'] ?>" id="post-<?= $val['id'] ?>"></i>
              <?php endif; ?>
              <span class="like-number"><?= $val['likes'] ?></span> like(s)
              <br>
              Snap by: <?= $val['username'] ?>
              <br>
              Date & Time: <?= $val['timestamp'] ?>
              <br>
            </p>
            <hr>
          </div>
		<?php endforeach; ?>
    </div>
  </div>
</div>



