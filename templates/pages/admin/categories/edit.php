<section class="section">
	<div class="form-container">
		<?php if(!empty($params['category'])): ?>
		<div class="form-card">
			<!-- Form Title -->
			<h2 class="form__title">Edit Category</h2>

			<!-- Form -->
			<form method="POST" action="/admin/categories/<?php echo $params['category']['id']; ?>/edit">
				<!-- Category Name Field -->
				<div class="form__group">
					<label for="name" class="form__label">Category Name</label>
					<input 
						type="text"
						id="name"
						name="name"
						class="form__input"
						placeholder="Enter category name"
						value="<?php echo htmlspecialchars($params['category']['name']); ?>"
						required
						minlength="2"
						maxlength="100"
						autofocus
					/>
				</div>

				<!-- Submit Button -->
				<button type="submit" class="form__submit">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
						<polyline points="17 21 17 13 7 13 7 21"></polyline>
						<polyline points="7 3 7 8 15 8"></polyline>
					</svg>
					Save Changes
				</button>
			</form>

			<!-- Footer Link -->
			<div class="form__footer">
				<p class="form__footer-text">
					<a href="/admin/categories" class="form__footer-link">Back to Categories</a>
				</p>
			</div>
		</div>
		<?php else: ?>
		<!-- Category Not Found -->
		<div class="form-card" style="text-align: center; padding: 3rem;">
			<p style="font-size: 1.8rem; color: rgba(255, 255, 255, 0.7); margin: 0 0 1.5rem 0;">
				Category not found.
			</p>
			<a href="/admin/categories" class="form__footer-link">
				Back to Categories
			</a>
		</div>
		<?php endif; ?>
	</div>
</section>
