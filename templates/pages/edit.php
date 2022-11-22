<section class="section news-creation">
	<form action="/news-edit/<?php echo $params['news']['id']; ?>" class="news-creation__form" method="post">
        <input type="hidden" name="id" value="<?php echo $params['news']['id']; ?>">
		<label for="title">News title</label>
		<input class="news-creation__title" type="text" name="title" id="title" value="<?php echo $params['news']['title']; ?>" />
		<label for="title">News content</label>
		<textarea
			class="news-creation__content"
			name="content"
			id="content"
			cols="30"
			rows="10"
		><?php echo $params['news']['content']; ?></textarea>
        <label for="active">Is Active</label>
        <input type="checkbox" name="active" id="active" 
        <?php
            if($params['news']['active']==1)
            {
                echo 'checked';
            }
        ?>
        >
		<button class="btn" type="submit">Edit</button>
	</form>
</section>
