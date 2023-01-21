<section class="section news">
	<p hidden id="ID_News"><?php echo $params['post']['id']; ?></p>
	<article class="news__content">
		<div class="news__information">
			<p class="news__author"></p>
			<p class="news created"></p>
		</div>
		<p class="news__text">
			<?php
echo $params['post']['content']; 
?>
		</p>
	</article>
</section>
<section id="comments"></section>
<script src=".././public/js/createComment.min.js"></script>
<script src=".././public/js/getComments.min.js"></script>
