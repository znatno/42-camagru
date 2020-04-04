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

            <div class="detail-box">
              <div class="actionBox">
                <ul class="comment-list">
                  <li>
                    <div class="commenter-image"><img src="http://placekitten.com/50/50"  alt=""/></div>
                    <div class="comment-text"><p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span></div>
                  </li>
                  <li>
                    <div class="commenter-image"><img src="http://placekitten.com/45/45"  alt=""/></div>
                    <div class="comment-text"><p class="">Hello this is a test comment and this comment is particularly very long and it goes on and on and on.</p> <span class="date sub-text">on March 5th, 2014</span></div>
                  </li>
                  <li>
                    <div class="commenter-image"><img src="http://placekitten.com/40/40"  alt=""/></div>
                    <div class="comment-text"><p class="">Hello this is a test comment.</p> <span class="date sub-text">on March 5th, 2014</span></div>
                  </li>
                </ul>

                <form class="form-inline" role="form">
                  <div class="form-group">
                    <input class="form-control" type="text" placeholder="Your comments" />
                  </div>
                  <div class="form-group">
                    <button class="btn btn-outline-default">Add</button>
                  </div>
                </form>
              </div>
            </div>

<!--            <form action="" method="post">-->
<!--              <div class="form-group">-->
<!--                <label for="comment">Comment </label>-->
<!--                <textarea rows="1" class="form-control form-control-sm mb-1" id="comment" name="comment" placeholder="Type your comment..."></textarea>-->
<!--                <input class="btn btn-primary btn-sm" type="submit" value="Comment">-->
<!--              </div>-->
<!--              <input id="photo-id" name="photo-id" type="hidden" value="--><?//= $val['id'] ?><!--">-->
<!--            </form>-->
<!--          </div>-->
		<?php endforeach; ?>
    </div>
  </div>
</div>



