<section class="section">
	<div class="admin-panel">
		<!-- Header with Create Button -->
		<div class="admin-panel__header">
			<h2 class="admin-panel__title">Manage Articles</h2>
			
			<a href="/news-create" class="admin-panel__create-btn">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<line x1="12" y1="5" x2="12" y2="19"></line>
					<line x1="5" y1="12" x2="19" y2="12"></line>
				</svg>
				Create Article
			</a>
		</div>

		<?php if(empty($params['articles'])): ?>
			<!-- Empty State -->
			<div style="padding: 4rem; text-align: center;">
				<p style="font-size: 1.8rem; color: rgba(255, 255, 255, 0.7);">
					No articles yet. <a href="/news-create" style="color: #8b5cf6;">Create your first article</a>
				</p>
			</div>
		<?php else: ?>
			<!-- Articles Table -->
			<table class="admin-table">
				<thead>
					<tr>
						<th>Title</th>
						<th>Category</th>
						<th>Author</th>
						<th>Created</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($params['articles'] as $article): ?>
					<tr>
						<!-- Title -->
						<td>
							<strong><?php echo htmlspecialchars(substr($article['title'], 0, 50)); ?></strong>
						</td>

						<!-- Category -->
						<td>
							<?php echo htmlspecialchars($article['category'] ?? 'Uncategorized'); ?>
						</td>

						<!-- Author -->
						<td>
							<?php echo htmlspecialchars($article['author_name'] ?? 'Unknown'); ?>
						</td>

						<!-- Date Created -->
						<td>
							<small><?php echo date('M d, Y', strtotime($article['created_at'])); ?></small>
						</td>

						<!-- Actions -->
						<td>
							<div class="admin-table__actions">
								<!-- View Button -->
								<a 
									href="/news-show/<?php echo $article['id']; ?>" 
									class="admin-table__action-btn"
									title="View Article"
								>
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
										<circle cx="12" cy="12" r="3"></circle>
									</svg>
								</a>

								<!-- Edit Button -->
								<a 
									href="/news-edit/<?php echo $article['id']; ?>" 
									class="admin-table__action-btn"
									title="Edit Article"
								>
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
										<path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
									</svg>
								</a>

								<!-- Delete Button -->
								<form 
									action="/admin/articles/<?php echo $article['id']; ?>/delete" 
									method="POST" 
									style="display: inline;"
									onsubmit="return confirm('Are you sure? This action cannot be undone.');"
								>
									<button 
										type="submit"
										class="admin-table__action-btn admin-table__action-btn--delete"
										title="Delete Article"
										style="border: none; background: none; cursor: pointer; padding: 0.5rem;"
									>
										<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
											<polyline points="3 6 5 6 21 6"></polyline>
											<path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
											<line x1="10" y1="11" x2="10" y2="17"></line>
											<line x1="14" y1="11" x2="14" y2="17"></line>
										</svg>
									</button>
								</form>
							</div>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
</section>
