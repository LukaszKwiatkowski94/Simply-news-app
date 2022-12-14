<section class="section news-list">
	<h2 class="section__header">News list</h2>
	<?php foreach($params['posts'] as $post): ?>
	<div class="news-list__single">
		<h3 class="news-list__header">
			<a href="/news-show/<?php echo $post['id']; ?>"
				><?php echo $post['title'] ?></a
			>
			
		</h3>
		<img
			class="news-list__img"
			src="./public/img/news_img.jpg"
			alt=""
			class="news-list__line"
		/>
		<p class="news-list__content"><?php echo $post['content'] ?></p>
		<p class="news-list__created"><?php echo $post['date_created'] ?></p>
		<a class="news-list__link" href="/news-show/<?php echo $post['id']; ?>"
			>Read more</a
		>
	</div>
	<?php endforeach; ?>
</section>
