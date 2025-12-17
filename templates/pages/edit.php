<section class="section">
	<div class="form-container">
		<div class="form-card form-card--wide">
			<!-- Form Title -->
			<h2 class="form__title">Edit News</h2>

			<!-- Edit News Form -->
			<form action="/news-edit/<?php echo $params['news']['id']; ?>" method="post">
				<!-- Title Field -->
				<div class="form__group">
					<label for="title" class="form__label">News Title</label>
					<input 
						type="text" 
						name="title" 
						id="title" 
						class="form__input"
						placeholder="Enter news title"
						value="<?php echo htmlspecialchars($params['news']['title']); ?>"
						required
						autofocus
						maxlength="250"
					/>
					<div style="text-align: right; margin-top: 0.8rem;">
						<span id="titleCounter" style="font-size: 1.4rem; color: rgba(255, 255, 255, 0.7);"></span>
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
					><?php echo htmlspecialchars($params['news']['content']); ?></textarea>
					<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.8rem;">
						<span style="font-size: 1.4rem; color: rgba(255, 255, 255, 0.5);">
							Tip: Use double line breaks to separate paragraphs
						</span>
						<span id="contentCounter" style="font-size: 1.4rem; color: rgba(255, 255, 255, 0.7);"></span>
					</div>
				</div>

				<!-- Active Status Toggle -->
				<div class="form__group">
					<label style="display: flex; align-items: center; gap: 1.2rem; cursor: pointer;">
						<input 
							type="checkbox" 
							name="active" 
							id="active" 
							value="1"
							<?php echo ($params['news']['active'] == 1) ? 'checked' : ''; ?>
							style="width: 2rem; height: 2rem; cursor: pointer;"
						/>
						<span class="form__label" style="margin: 0; cursor: pointer;">
							Active (visible to public)
						</span>
					</label>
				</div>

				<!-- Action Buttons -->
				<div style="display: flex; gap: 1.6rem; flex-wrap: wrap;">
					<button type="submit" class="form__submit" style="flex: 1; min-width: 200px;">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
							<polyline points="17 21 17 13 7 13 7 21"></polyline>
							<polyline points="7 3 7 8 15 8"></polyline>
						</svg>
						Save Changes
					</button>

					<a 
						href="/news-show/<?php echo $params['news']['id']; ?>" 
						class="btn"
						style="flex: 1; min-width: 200px; text-decoration: none; justify-content: center;"
					>
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
							<circle cx="12" cy="12" r="3"></circle>
						</svg>
						Preview
					</a>
				</div>

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

<!-- Character Counter Script -->
<script>
// Title counter
const titleInput = document.getElementById('title');
const titleCounter = document.getElementById('titleCounter');

if (titleInput && titleCounter) {
	// Initial count
	const updateTitleCounter = () => {
		const length = titleInput.value.length;
		titleCounter.textContent = `${length}/250`;
		
		if (length > 230) {
			titleCounter.style.color = 'rgb(252, 165, 165)';
		} else {
			titleCounter.style.color = 'rgba(255, 255, 255, 0.7)';
		}
	};
	
	updateTitleCounter();
	titleInput.addEventListener('input', updateTitleCounter);
}

// Content counter
const contentTextarea = document.getElementById('content');
const contentCounter = document.getElementById('contentCounter');

if (contentTextarea && contentCounter) {
	const updateContentCounter = () => {
		const length = contentTextarea.value.length;
		contentCounter.textContent = `${length} characters`;
	};
	
	updateContentCounter();
	contentTextarea.addEventListener('input', updateContentCounter);
}
</script>