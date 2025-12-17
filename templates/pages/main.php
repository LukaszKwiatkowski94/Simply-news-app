<section class="section">
	<div class="wrapper">
		<!-- Section Header -->
		<h2 class="section__header">News List</h2>

		<?php if(empty($params['posts'])): ?>
			<!-- No posts available -->
			<div class="glass-card" style="padding: 4rem; text-align: center;">
				<p style="font-size: 1.8rem; color: rgba(255, 255, 255, 0.7);">
					No news articles available yet. Check back soon!
				</p>
			</div>
		<?php else: ?>
			<?php 
			// Get first post for hero section
			$firstPost = array_shift($params['posts']); 
			?>

			<!-- Hero News (First/Latest Post) -->
			<?php if($firstPost): ?>
			<article class="news-hero">
				<a href="/news-show/<?php echo $firstPost['id']; ?>" style="text-decoration: none;">
					<div class="news-hero__image-wrapper">
						<img 
							src="./public/img/news_img.jpg" 
							alt="<?php echo htmlspecialchars($firstPost['title']); ?>" 
							class="news-hero__image"
							loading="eager"
						/>
						<div class="news-hero__overlay"></div>
						
						<div class="news-hero__content">
							<!-- Meta information -->
							<div class="news-hero__meta">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
									<line x1="16" y1="2" x2="16" y2="6"></line>
									<line x1="8" y1="2" x2="8" y2="6"></line>
									<line x1="3" y1="10" x2="21" y2="10"></line>
								</svg>
								<span><?php echo $firstPost['date_created']; ?></span>
							</div>

							<!-- Title -->
							<h2 class="news-hero__title">
								<?php echo htmlspecialchars($firstPost['title']); ?>
							</h2>

							<!-- Excerpt -->
							<p class="news-hero__excerpt">
								<?php 
								// Limit content to 200 characters for excerpt
								$excerpt = strip_tags($firstPost['content']);
								echo htmlspecialchars(mb_substr($excerpt, 0, 200)) . (mb_strlen($excerpt) > 200 ? '...' : ''); 
								?>
							</p>

							<!-- Read more button -->
							<button class="news-hero__btn">
								Read More
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<line x1="5" y1="12" x2="19" y2="12"></line>
									<polyline points="12 5 19 12 12 19"></polyline>
								</svg>
							</button>
						</div>
					</div>
				</a>
			</article>
			<?php endif; ?>

			<!-- Regular News Grid (Remaining Posts) -->
			<?php if(!empty($params['posts'])): ?>
			<div class="news-grid">
				<?php foreach($params['posts'] as $post): ?>
				<article class="news-card">
					<a href="/news-show/<?php echo $post['id']; ?>" style="text-decoration: none;">
						<!-- Image -->
						<div class="news-card__image-wrapper">
							<img 
								src="./public/img/news_img.jpg" 
								alt="<?php echo htmlspecialchars($post['title']); ?>" 
								class="news-card__image"
								loading="lazy"
							/>
						</div>

						<!-- Content -->
						<div class="news-card__content">
							<!-- Title -->
							<h3 class="news-card__title">
								<?php echo htmlspecialchars($post['title']); ?>
							</h3>

							<!-- Excerpt -->
							<p class="news-card__excerpt">
								<?php 
								// Limit content to 150 characters for card excerpt
								$excerpt = strip_tags($post['content']);
								echo htmlspecialchars(mb_substr($excerpt, 0, 150)) . (mb_strlen($excerpt) > 150 ? '...' : ''); 
								?>
							</p>

							<!-- Footer with meta and button -->
							<div class="news-card__footer">
								<div class="news-card__meta">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
										<line x1="16" y1="2" x2="16" y2="6"></line>
										<line x1="8" y1="2" x2="8" y2="6"></line>
										<line x1="3" y1="10" x2="21" y2="10"></line>
									</svg>
									<span><?php echo $post['date_created']; ?></span>
								</div>

								<button class="news-card__btn">
									Read More
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<line x1="5" y1="12" x2="19" y2="12"></line>
										<polyline points="12 5 19 12 12 19"></polyline>
									</svg>
								</button>
							</div>
						</div>
					</a>
				</article>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

		<?php endif; ?>
	</div>
</section>