<section class="section">
	<div class="form-container">
		<div class="form-card">
			<!-- Form Title -->
			<h2 class="form__title">Create Category</h2>

			<!-- Form -->
			<form method="POST" action="/admin/categories/create">
				<!-- Category Name Field -->
				<div class="form__group">
					<label for="name" class="form__label">Category Name</label>
					<input 
						type="text"
						id="name"
						name="name"
						class="form__input"
						placeholder="Enter category name"
						required
						minlength="2"
						maxlength="100"
						autofocus
					/>
				</div>

				<!-- Submit Button -->
				<button type="submit" class="form__submit">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M12 5v14M5 12h14"></path>
					</svg>
					Create Category
				</button>
			</form>

			<!-- Footer Link -->
			<div class="form__footer">
				<p class="form__footer-text">
					<a href="/admin/categories" class="form__footer-link">Back to Categories</a>
				</p>
			</div>
		</div>
	</div>
</section>
