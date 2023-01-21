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
<div class="alert">
	<!-- This if for alert -->
</div>
<section id="comments" class="comments">
	<?php
		if(isset($_SESSION['user'])) { ?>
	<form id="myForm" action="javascript:void(0);">
		<h3 class="comments__header">Add your comment:</h3>
		<textarea
			name="content"
			id="contentComment"
			id=""
			cols="30"
			rows="10"
		></textarea>
		<button class="btn" id="AddComment">Add comment</button>
	</form>
	
	<script src=".././public/js/createComment.min.js"></script>
	<?php
		}
	?></section>
<script src=".././public/js/getComments.min.js"></script>
