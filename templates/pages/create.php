<section class="section">
	<div class="form-container">
		<div class="form-card form-card--wide">
			<!-- Form Title -->
			<h2 class="form__title">Create News</h2>

			<!-- Create News Form -->
			<form action="/news-create" method="post">
				<!-- Title Field -->
				<div class="form__group">
					<label for="title" class="form__label">News Title</label>
					<input 
						type="text" 
						name="title" 
						id="title" 
						class="form__input"
						placeholder="Enter news title"
						required
						autofocus
						maxlength="250"
					/>
					<div style="text-align: right; margin-top: 0.8rem;">
						<span id="titleCounter" style="font-size: 1.4rem; color: rgba(255, 255, 255, 0.7);">0/250</span>
					</div>
				</div>

				<!-- Content Field -->
				<div class="form__group">
					<label for="content" class="form__label">News Content</label>
					<textarea 
						name="content" 
						id="content" 
						class="form__textarea"
						placeholder="Write your news content here..."
						required
						rows="15"
					></textarea>
					<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.8rem;">
						<span style="font-size: 1.4rem; color: rgba(255, 255, 255, 0.5);">
							Tip: Use double line breaks to separate paragraphs
						</span>
						<span id="contentCounter" style="font-size: 1.4rem; color: rgba(255, 255, 255, 0.7);">0 characters</span>
					</div>
				</div>

				<!-- Submit Button -->
				<button type="submit" class="form__submit">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<line x1="12" y1="5" x2="12" y2="19"></line>
						<line x1="5" y1="12" x2="19" y2="12"></line>
					</svg>
					Create News
				</button>

				<!-- Back Link -->
				<div class="form__footer">
					<p class="form__footer-text">
						<a href="/news-list" class="form__footer-link">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 0.4rem;">
								<line x1="19" y1="12" x2="5" y2="12"></line>
								<polyline points="12 19 5 12 12 5"></polyline>
							</svg>
							Back to News List
						</a>
					</p>
				</div>
			</form>
		</div>
	</div>
</section>

<!-- Optional: Character Counter Script -->
<script>
// Title counter
const titleInput = document.getElementById('title');
const titleCounter = document.getElementById('titleCounter');

if (titleInput && titleCounter) {
	titleInput.addEventListener('input', () => {
		const length = titleInput.value.length;
		titleCounter.textContent = `${length}/250`;
		
		if (length > 230) {
			titleCounter.style.color = 'rgb(252, 165, 165)';
		} else {
			titleCounter.style.color = 'rgba(255, 255, 255, 0.7)';
		}
	});
}

// Content counter
const contentTextarea = document.getElementById('content');
const contentCounter = document.getElementById('contentCounter');

if (contentTextarea && contentCounter) {
	contentTextarea.addEventListener('input', () => {
		const length = contentTextarea.value.length;
		contentCounter.textContent = `${length} characters`;
	});
}
</script>