<div class="container">
    <h1 class="mt-4 mb-4">Main Page</h1>
    <div class="row">
        <div class="col-lg-8 mb-4 p-0">
			<?php foreach ($photos as $val): ?>
            <div class="col-lg-12 mb-4 post">
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

                <div class="col-lg-8 mb-4 p-3 comment-section">
					<?php if (isset($val['comments']) && !empty($val['comments'])): ?>
                        <ul class="comment-list">
							<?php foreach ($val['comments'] as $comment): ?>
                                <li class="comment-list-elem">
                                    <div class="comment-div">
                                        <p class="comment-text">Text: <?= $comment['text'] ?></p>
                                        <span class="date sub-text">Date: <?= $comment['date'] ?></span>
                                    </div>
                                </li>
							<?php endforeach; ?>
                        </ul>
					<?php endif;?>
                    <div>

                        <p class="text-muted mb-0"><label for="comment-input-X">Comment</label></p>
                        <form class="form-row" role="form">

                            <br>
                            <div class="form-group col-md-10 mb-0">
                                <input class="form-control" type="text" placeholder="Type your comment" id="comment-input-X"/>
                            </div>
                            <div class="form-group col-md-2 mb-0">
                                <button class="btn btn-outline-primary btn-block">Add</button>
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

				<?php endforeach; ?>
            </div>
        </div>
    </div>
</div>



