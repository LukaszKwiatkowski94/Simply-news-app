<section class="section">
	<div class="admin-panel">
		<!-- Header with Create Button -->
		<div class="admin-panel__header">
			<h2 class="admin-panel__title">Manage Categories</h2>
			
			<a href="/admin/categories/create" class="admin-panel__create-btn">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<line x1="12" y1="5" x2="12" y2="19"></line>
					<line x1="5" y1="12" x2="19" y2="12"></line>
				</svg>
				Create Category
			</a>
		</div>

		<?php if(empty($params['categories'])): ?>
			<!-- Empty State -->
			<div style="padding: 4rem; text-align: center;">
				<p style="font-size: 1.8rem; color: rgba(255, 255, 255, 0.7);">
					No categories yet. <a href="/admin/categories/create" style="color: #8b5cf6;">Create your first category</a>
				</p>
			</div>
		<?php else: ?>
			<!-- Categories Table -->
			<table class="admin-table">
				<thead>
					<tr>
						<th>Category Name</th>
						<th>Articles</th>
						<th>Created</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($params['categories'] as $category): ?>
					<tr>
						<!-- Category Name -->
						<td>
							<strong><?php echo htmlspecialchars($category['name']); ?></strong>
						</td>

						<!-- Article Count -->
						<td>
							<span style="background: rgba(139, 92, 246, 0.2); padding: 0.4rem 0.8rem; border-radius: 4px; font-weight: 500;">
								<?php echo $category['article_count'] ?? 0; ?> 
								<?php echo ($category['article_count'] ?? 0) == 1 ? 'article' : 'articles'; ?>
							</span>
						</td>

						<!-- Created Date -->
						<td>
						<small><?php echo $category['dateCreated'] ? date('M d, Y', strtotime($category['dateCreated'])) : '-'; ?></small>
						<!-- Actions -->
						<td>
							<div class="admin-table__actions">
								<!-- Edit Button -->
								<a 
									href="/admin/categories/<?php echo $category['id']; ?>/edit" 
									class="admin-table__action-btn"
									title="Edit Category"
								>
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
										<path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
									</svg>
								</a>

								<!-- Delete Button -->
								<form 
									action="/admin/categories/<?php echo $category['id']; ?>/delete" 
									method="POST" 
									style="display: inline;"
									onsubmit="return confirm('Delete category? Articles in this category will be preserved.');"
								>
									<button 
										type="submit"
										class="admin-table__action-btn admin-table__action-btn--delete"
										title="Delete Category"
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
