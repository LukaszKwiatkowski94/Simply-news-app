<!-- Hidden News ID for JavaScript -->
<p hidden id="ID_News"><?php echo $params['post']['id']; ?></p>

<!-- Breadcrumbs -->
<div class="breadcrumbs">
	<div class="wrapper">
		<ul class="breadcrumbs__list">
			<li class="breadcrumbs__item">
				<a href="/" class="breadcrumbs__link">Home</a>
			</li>
			<li class="breadcrumbs__item breadcrumbs__separator">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<polyline points="9 18 15 12 9 6"></polyline>
				</svg>
			</li>
			<li class="breadcrumbs__item">
				<span>News Article</span>
			</li>
		</ul>
	</div>
</div>

<!-- News Article -->
<article class="news-article">
	<div class="wrapper">
		<!-- Hero Image -->
		<div class="news-article__hero">
			<img 
				src="../../public/img/news_img.jpg" 
				alt="<?php echo htmlspecialchars($params['post']['title']); ?>" 
				class="news-article__hero-image"
				loading="eager"
			/>
			<div class="news-article__hero-overlay"></div>
		</div>

		<!-- Article Body -->
		<div class="news-article__body">
			<!-- Meta Information -->
			<div class="news-article__meta">
				<div class="news-article__meta-item">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
						<line x1="16" y1="2" x2="16" y2="6"></line>
						<line x1="8" y1="2" x2="8" y2="6"></line>
						<line x1="3" y1="10" x2="21" y2="10"></line>
					</svg>
					<span><?php echo $params['post']['date_created']; ?></span>
				</div>
				
				<div class="news-article__meta-separator"></div>
				
				<div class="news-article__meta-item">
					<span>by <?php echo htmlspecialchars($params['post']['author'] ?? 'Admin'); ?></span>
				</div>
			</div>

			<!-- Title -->
			<h1 class="news-article__title">
				<?php echo htmlspecialchars($params['post']['title']); ?>
			</h1>

			<!-- Content -->
			<div class="news-article__content">
				<?php 
				// Split content by double line breaks to create paragraphs
				$content = $params['post']['content'];
				$paragraphs = preg_split('/\n\s*\n/', $content);
				
				foreach($paragraphs as $paragraph) {
					$trimmed = trim($paragraph);
					if (!empty($trimmed)) {
						echo '<p>' . nl2br(htmlspecialchars($trimmed)) . '</p>';
					}
				}
				?>
			</div>
		</div>
	</div>
</article>

<!-- Alert Container (for JS messages) -->
<div class="alert" style="display: none;"></div>

<!-- Comments Section -->
<section id="comments" class="comments">
	<div class="wrapper">
		<!-- Comments Header -->
		<div class="comments__header">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
			</svg>
			<h3 class="comments__title">Comments</h3>
		</div>

		<?php if($this->user->isLoggedIn()): ?>
			<!-- Comment Form (for logged in users) -->
			<div class="comments__form" id="myForm">
				<textarea 
					name="content" 
					id="contentComment" 
					class="comments__textarea"
					rows="4"
					placeholder="Add your comment... (max 500 characters)"
					maxlength="500"
				></textarea>
				
				<!-- Optional: Character counter -->
				<div style="text-align: right; margin-bottom: 1.6rem;">
					<span id="charCounter" style="font-size: 1.4rem; color: rgba(255, 255, 255, 0.7);">0/500</span>
				</div>

				<button class="comments__submit" id="AddComment" type="button">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<line x1="22" y1="2" x2="11" y2="13"></line>
						<polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
					</svg>
					Add Comment
				</button>
			</div>
		<?php else: ?>
			<!-- Login Prompt (for guests) -->
			<div class="comments__login-prompt">
				<p>
					<a href="/login" class="comments__login-link">Log in</a> to add comments
				</p>
			</div>
		<?php endif; ?>

		<!-- Comments List (will be populated by JS) -->
		<div class="comments__list">
			<!-- Comments will be loaded here by getComments.js -->
		</div>
	</div>
</section>

<!-- JavaScript for Comments -->
<script src=".././public/js/getComments.min.js"></script>
<?php if($this->user->isLoggedIn()): ?>
<script src=".././public/js/createComment.min.js"></script>
<?php endif; ?>