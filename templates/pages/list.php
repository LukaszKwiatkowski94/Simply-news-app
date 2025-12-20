<section class="section">
	<div class="admin-panel">
		<!-- Header with Create Button -->
		<div class="admin-panel__header">
			<h2 class="admin-panel__title">News List (Admin)</h2>
			
			<a href="/news-create" class="admin-panel__create-btn">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<line x1="12" y1="5" x2="12" y2="19"></line>
					<line x1="5" y1="12" x2="19" y2="12"></line>
				</svg>
				Create News
			</a>
		</div>

		<?php if(empty($params['news'])): ?>
			<!-- Empty State -->
			<div style="padding: 4rem; text-align: center;">
				<p style="font-size: 1.8rem; color: rgba(255, 255, 255, 0.7);">
					No news articles yet. Create your first article!
				</p>
			</div>
		<?php else: ?>
			<!-- News Table -->
			<table class="admin-table">
				<thead>
					<tr>
						<th>Title</th>
						<th>Status</th>
						<th>Date Created</th>
						<th>Date Updated</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($params['news'] as $news): ?>
					<tr>
						<!-- Title -->
						<td>
							<?php echo htmlspecialchars($news['title']); ?>
						</td>

						<!-- Status -->
						<td>
							<?php if($news['active'] == 1): ?>
								<span class="admin-table__status admin-table__status--active">
									Active
								</span>
							<?php else: ?>
								<span class="admin-table__status admin-table__status--inactive">
									Inactive
								</span>
							<?php endif; ?>
						</td>

						<!-- Date Created -->
						<td>
							<?php echo $news['dateCreated']; ?>
						</td>

						<!-- Date Updated -->
						<td>
							<?php echo $news['dateLastUpdated'] ?? '-'; ?>
						</td>

						<!-- Actions -->
						<td>
							<div class="admin-table__actions">
								<!-- Show Button -->
								<a 
									href="/news-show/<?php echo $news['id']; ?>" 
									class="admin-table__action-btn"
									title="View"
								>
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
										<circle cx="12" cy="12" r="3"></circle>
									</svg>
								</a>

								<!-- Edit Button -->
								<a 
									href="/news-edit/<?php echo $news['id']; ?>" 
									class="admin-table__action-btn"
									title="Edit"
								>
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
										<path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
									</svg>
								</a>

								<!-- Delete Button -->
								<a 
									href="/news-delete/<?php echo $news['id']; ?>" 
									class="admin-table__action-btn admin-table__action-btn--delete"
									title="Delete"
									onclick="return confirm('Are you sure you want to delete this article? This action cannot be undone.');"
								>
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<polyline points="3 6 5 6 21 6"></polyline>
										<path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
										<line x1="10" y1="11" x2="10" y2="17"></line>
										<line x1="14" y1="11" x2="14" y2="17"></line>
									</svg>
								</a>
							</div>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
</section>