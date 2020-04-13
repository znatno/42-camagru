<div class="container">
    <h1 class="mt-4 mb-4">Main Page</h1>
    <div class="col-lg-8 mb-4 p-0">

		<?php foreach ($photos_arr as $photo): ?>

        <div class="col-lg-12 mb-5 post p-0">

            <img src="<?= $photo['path'] ?>" alt="Error image" width="546">

            <div class="row mt-2 mb-3 p-0">
                <div class="col-md-3 text-center">
                    <span class="float-md-left">
                        <?php if (isset($_SESSION['user'])): ?>
                            <i onclick="changeLikeHandler(this)" class="fa <?= $photo['liked'] ?>" id="post-<?= $photo['id'] ?>"></i>
						<?php endif; ?>
                        <span class="like-number"><?= $photo['likes'] ?></span><?= $photo['likes-txt'] ?>
                    </span>
                </div>
                <div class="col-md-6 text-center">
                    <span class="float-md-right">
                        <b><?= $photo['username'] ?></b>
                        <span class="post-date"> on <?= $photo['date'] ?></span>
                    </span>
                </div>
            </div>

            <div class="col-lg-9 mb-4 p-3 comment-section">
				<?= $photo['comments'] ? "Comments: {$photo['comments']}" : "No comments"  ?>

				<?php if (isset($photo['user-comments']) && !empty($photo['user-comments'])): ?>
                    <ul class="comment-list mb-0">
						<?php foreach ($photo['user-comments'] as $comment): ?>
                            <li class="comment-list-elem mb-1">
                                <div class="comment-div">
                                    <h6 class="mb-1"><?= $comment['username'] ?></h6>
                                    <p class="comment-text"><?= $comment['text'] ?></p>
                                    <span class="date sub-text"><?= $comment['date'] ?></span>
									<?php if (isset($_SESSION['user']) && $_SESSION['user']['username'] == $comment['username']): ?>
                                        <button onclick="deleteCommentHandler('<?=$photo['id']?>','<?=$comment['timestamp']?>','<?=$comment['username']?>');" type="button" class="btn btn-outline-danger btn-sm">Delete</button>
									<?php endif; ?>
                                </div>
                            </li>
						<?php endforeach; ?>

                    </ul>
				<?php endif;?>
				<?php if (isset($_SESSION['user'])): ?>
                    <div class="">
                        <hr>
                        <p class="text-muted mb-0"><label for="comment-input-<?= $photo['id'] ?>">Comment</label></p>
                        <form class="form-row" role="form" method="post"
                              onsubmit="return commentHandler(this.children[0].children[0].value, <?= $photo['id'] ?>);"
                              id="comment-form-<?= $photo['id'] ?>">
                            <div class="form-group col-md-10 mb-0">
                                <input class="form-control" type="text" placeholder="Type your comment" id="comment-input-<?= $photo['id'] ?>"/>
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
        <nav aria-label="Page navigation example">
            <ul class="pagination">
				<?php for ($i = 1; $i <= $nb_pages; $i++): ?>
                    <li class="page-item"><a class="page-link" href="/?page=<?=$i?>"><?=$i?></a></li>
				<?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>



