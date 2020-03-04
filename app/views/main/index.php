

<p> Main Page </p>
<br>

<?php foreach ($news as $val): ?>
    <h4><?=$val['title']?></h4>
    <p><?=$val['text']?></p>
    <hr>
<?php endforeach; ?>

