<section class="section">
	<div class="admin-panel">
		<div class="admin-panel__header">
			<h1 class="admin-panel__title">Admin Dashboard</h1>
			<p style="color: rgba(255, 255, 255, 0.7); font-size: 1.6rem; margin: 0.8rem 0 0 0;">Welcome to the administration panel</p>
		</div>

		<!-- Statistics Grid -->
		<div class="stats-grid">
			<div class="stat-card">
				<div class="stat-icon articles">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
						<path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
					</svg>
				</div>
				<h3 style="color: white; font-size: 1.8rem; margin: 0 0 0.8rem 0; font-weight: 600;">Articles</h3>
				<p class="stat-number"><?php echo $params['articlesCount'] ?? 0; ?></p>
				<a href="/admin/articles" style="color: #8b5cf6; text-decoration: none; font-size: 1.4rem; font-weight: 500; transition: color 0.2s ease;">Manage Articles →</a>
			</div>

			<div class="stat-card">
				<div class="stat-icon categories">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<circle cx="12" cy="12" r="1"></circle>
						<path d="M12 1v6m0 6v6"></path>
						<path d="M4.22 4.22l4.24 4.24M15.54 15.54l4.24 4.24"></path>
						<path d="M1 12h6m6 0h6"></path>
						<path d="M4.22 19.78l4.24-4.24M15.54 8.46l4.24-4.24"></path>
					</svg>
				</div>
				<h3 style="color: white; font-size: 1.8rem; margin: 0 0 0.8rem 0; font-weight: 600;">Categories</h3>
				<p class="stat-number"><?php echo $params['categoriesCount'] ?? 0; ?></p>
				<a href="/admin/categories" style="color: #8b5cf6; text-decoration: none; font-size: 1.4rem; font-weight: 500; transition: color 0.2s ease;">Manage Categories →</a>
			</div>

			<div class="stat-card">
				<div class="stat-icon users">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
						<circle cx="9" cy="7" r="4"></circle>
						<path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
						<path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
					</svg>
				</div>
				<h3 style="color: white; font-size: 1.8rem; margin: 0 0 0.8rem 0; font-weight: 600;">Users</h3>
				<p class="stat-number"><?php echo $params['usersCount'] ?? 0; ?></p>
				<a href="/admin/users" style="color: #8b5cf6; text-decoration: none; font-size: 1.4rem; font-weight: 500; transition: color 0.2s ease;">Manage Users →</a>
			</div>
		</div>

		<!-- Quick Actions -->
		<div style="backdrop-filter: blur(16px) saturate(180%); -webkit-backdrop-filter: blur(16px) saturate(180%); background-color: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 2.4rem; padding: 3.2rem;">
			<h2 style="font-size: 3.2rem; font-weight: 700; color: white; margin-top: 0; margin-bottom: 2.4rem;">Quick Actions</h2>
			<ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1.2rem;">
				<li>
					<a href="/admin/articles" style="color: rgba(255, 255, 255, 0.9); text-decoration: none; font-size: 1.6rem; font-weight: 500; transition: color 0.2s ease; display: inline-block;">
						📰 View all articles
					</a>
				</li>
				<li>
					<a href="/admin/categories" style="color: rgba(255, 255, 255, 0.9); text-decoration: none; font-size: 1.6rem; font-weight: 500; transition: color 0.2s ease; display: inline-block;">
						📂 View all categories
					</a>
				</li>
				<li>
					<a href="/admin/users" style="color: rgba(255, 255, 255, 0.9); text-decoration: none; font-size: 1.6rem; font-weight: 500; transition: color 0.2s ease; display: inline-block;">
						👥 View all users
					</a>
				</li>
			</ul>
		</div>
	</div>
</section>

<style>
	.stats-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
		gap: 2rem;
		margin-bottom: 3.2rem;
	}

	.stat-card {
		backdrop-filter: blur(16px) saturate(180%);
		-webkit-backdrop-filter: blur(16px) saturate(180%);
		background-color: rgba(255, 255, 255, 0.1);
		border: 1px solid rgba(255, 255, 255, 0.2);
		border-radius: 2.4rem;
		padding: 2.4rem;
		box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
		transition: all 0.3s ease;
	}

	.stat-card:hover {
		background-color: rgba(255, 255, 255, 0.15);
		transform: translateY(-4px);
	}

	.stat-icon {
		width: 6.4rem;
		height: 6.4rem;
		border-radius: 1.6rem;
		display: flex;
		align-items: center;
		justify-content: center;
		margin-bottom: 1.6rem;
		color: white;
	}

	.stat-icon.articles {
		background: linear-gradient(135deg, rgba(139, 92, 246, 0.3) 0%, rgba(139, 92, 246, 0.1) 100%);
		border: 1px solid rgba(139, 92, 246, 0.3);
	}

	.stat-icon.categories {
		background: linear-gradient(135deg, rgba(59, 130, 246, 0.3) 0%, rgba(59, 130, 246, 0.1) 100%);
		border: 1px solid rgba(59, 130, 246, 0.3);
	}

	.stat-icon.users {
		background: linear-gradient(135deg, rgba(236, 72, 153, 0.3) 0%, rgba(236, 72, 153, 0.1) 100%);
		border: 1px solid rgba(236, 72, 153, 0.3);
	}

	.stat-number {
		font-size: 4.8rem;
		font-weight: 700;
		background: linear-gradient(135deg, #8b5cf6 0%, #3b82f6 100%);
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		background-clip: text;
		margin: 0 0 1.2rem 0;
	}
</style>
