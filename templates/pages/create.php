<section class="section news-creation">
	<form action="/news-create" class="news-creation__form" method="post">
		<label for="title">News title</label>
		<input class="news-creation__title" type="text" name="title" id="title" required />
		<label for="title">News content</label>
		<textarea
			class="news-creation__content"
			name="content"
			id=""
			cols="30"
			rows="10"
			required
		></textarea>
		<button class="btn" type="submit">Create</button>
	</form>
</section>
