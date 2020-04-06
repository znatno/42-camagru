<div class="container">
    <h1 class="mt-4 mb-4">Main Page</h1>
    <div class="col-lg-8 mb-4 p-0">

		<?php foreach ($photos as $val): ?>

        <div class="col-lg-12 mb-5 post p-0">

            <img src="<?= $val['path'] ?>" alt="Error image" width="480">

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
				<?= $val['comments'] ? "Comments: {$val['comments']}" : "No comments"  ?>

				<?php if (isset($val['user-comments']) && !empty($val['user-comments'])): ?>
                    <ul class="comment-list">
						<?php debug($val); ?>
						<?php foreach ($val['user-comments'] as $comment): ?>
                            <li class="comment-list-elem">
                                <div class="comment-div">
                                    <p class="comment-text">Text: <?= $comment['text'] ?></p>
                                    <span class="date sub-text">Date: <?= $comment['date'] ?></span>
                                    <!-- TODO: Add author -->
									<?php if ($_SESSION['user']['username'] == $comment['username']): ?>
                                        <!-- TODO: Add delete comment -->
									<?php endif; ?>
                                </div>
                            </li>
						<?php endforeach; ?>

                    </ul>
				<?php endif;?>
				<?php if (isset($_SESSION['user'])): ?>
                    <div class="">
                        <hr>
                        <p class="text-muted mb-0"><label for="comment-input-<?= $val['id'] ?>">Comment</label></p>
                        <form class="form-row" role="form" method="post"
                              onsubmit="return commentHandler(this.children[0].children[0].value, <?= $val['id'] ?>);"
                              id="comment-form-<?= $val['id'] ?>">
                            <div class="form-group col-md-10 mb-0">
                                <input class="form-control" type="text" placeholder="Type your comment" id="comment-input-<?= $val['id'] ?>"/>
                            </div>
                            <div class="form-group col-md-2 mb-0">
                                <button class="btn btn-outline-primary btn-block">Add</button>
                            </div>

                        </form>
                    </div>
				<?php endif; ?>

            </div>

        </div>

		<?php endforeach; ?>

    </div>
</div>



