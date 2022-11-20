This is main page<br>
<?php foreach($params['posts'] as $post): ?>
    <div class="posts">
        <div class="posts__header"><?php echo $post['title'] ?></div>
        <div class="posts__short-content"><?php echo $post['content'] ?></div>
        <div class="posts__date-created"><?php echo $post['date_created'] ?></div>
        <a href="?action=show&id=<?php echo $post['id']; ?>">Read more</a>
    </div>
<?php endforeach; ?>