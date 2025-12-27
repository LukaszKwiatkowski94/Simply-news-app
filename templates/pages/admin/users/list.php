<div class="admin-users">
	<div class="users-header">
		<h1>User Management</h1>
		<p>Manage user roles, permissions, and accounts</p>
	</div>

	<?php if(empty($params['users'])): ?>
		<div class="empty-state">
			<p>No users found.</p>
		</div>
	<?php else: ?>
		<div class="users-table-container">
			<table class="users-table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Username</th>
						<th>Name</th>
						<th>Role</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($params['users'] as $user): ?>
						<tr>
							<td><?php echo htmlspecialchars($user['id']); ?></td>
							<td><?php echo htmlspecialchars($user['username']); ?></td>
							<td><?php echo htmlspecialchars($user['name'] . ' ' . $user['surname']); ?></td>
							<td>
								<span class="role-badge <?php echo $user['is_admin'] ? 'admin' : 'user'; ?>">
									<?php echo $user['is_admin'] ? 'Admin' : 'User'; ?>
								</span>
							</td>
							<td>
								<span class="status-badge <?php echo $user['active'] ? 'active' : 'blocked'; ?>">
									<?php echo $user['active'] ? 'Active' : 'Blocked'; ?>
								</span>
							</td>
							<td>
								<div class="actions">
									<form method="POST" action="/admin/users/<?php echo $user['id']; ?>/toggle-role" style="display: inline;">
										<button type="submit" class="btn-action btn-toggle-role">
											<?php echo $user['is_admin'] ? 'Revoke Admin' : 'Grant Admin'; ?>
										</button>
									</form>

									<form method="POST" action="/admin/users/<?php echo $user['id']; ?>/toggle-status" style="display: inline;">
										<button type="submit" class="btn-action btn-toggle-status">
											<?php echo $user['active'] ? 'Block' : 'Unblock'; ?>
										</button>
									</form>

									<?php if($user['id'] !== $this->user->getUserId()): ?>
										<form method="POST" action="/admin/users/<?php echo $user['id']; ?>/delete" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
											<button type="submit" class="btn-action btn-delete">Delete</button>
										</form>
									<?php endif; ?>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	<?php endif; ?>
</div>

<style>
	.admin-users {
		padding: 20px;
	}

	.users-header {
		margin-bottom: 30px;
	}

	.users-header h1 {
		font-size: 28px;
		margin-top: 0;
		margin-bottom: 8px;
		color: #111827;
	}

	.users-header p {
		color: #6b7280;
		font-size: 14px;
		margin: 0;
	}

	.empty-state {
		background: white;
		border: 1px solid #e5e7eb;
		border-radius: 8px;
		padding: 40px;
		text-align: center;
		color: #6b7280;
	}

	.users-table-container {
		background: white;
		border: 1px solid #e5e7eb;
		border-radius: 8px;
		overflow: hidden;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
	}

	.users-table {
		width: 100%;
		border-collapse: collapse;
		font-size: 14px;
	}

	.users-table thead {
		background-color: #f9fafb;
		border-bottom: 2px solid #e5e7eb;
	}

	.users-table th {
		padding: 16px;
		text-align: left;
		font-weight: 600;
		color: #374151;
		white-space: nowrap;
	}

	.users-table td {
		padding: 16px;
		border-bottom: 1px solid #e5e7eb;
		color: #111827;
	}

	.users-table tbody tr:hover {
		background-color: #f9fafb;
	}

	.role-badge, .status-badge {
		display: inline-block;
		padding: 4px 12px;
		border-radius: 20px;
		font-size: 12px;
		font-weight: 500;
	}

	.role-badge.admin {
		background-color: #dbeafe;
		color: #1e40af;
	}

	.role-badge.user {
		background-color: #f3f4f6;
		color: #374151;
	}

	.status-badge.active {
		background-color: #d1fae5;
		color: #065f46;
	}

	.status-badge.blocked {
		background-color: #fee2e2;
		color: #991b1b;
	}

	.actions {
		display: flex;
		gap: 8px;
		flex-wrap: wrap;
	}

	.btn-action {
		padding: 6px 12px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
		font-size: 12px;
		font-weight: 500;
		transition: all 0.2s ease;
		font-family: inherit;
	}

	.btn-toggle-role {
		background-color: #3b82f6;
		color: white;
	}

	.btn-toggle-role:hover {
		background-color: #2563eb;
	}

	.btn-toggle-status {
		background-color: #f59e0b;
		color: white;
	}

	.btn-toggle-status:hover {
		background-color: #d97706;
	}

	.btn-delete {
		background-color: #ef4444;
		color: white;
	}

	.btn-delete:hover {
		background-color: #dc2626;
	}

	@media (max-width: 768px) {
		.users-table {
			font-size: 12px;
		}

		.users-table th, .users-table td {
			padding: 12px 8px;
		}

		.actions {
			flex-direction: column;
		}

		.btn-action {
			width: 100%;
		}
	}
</style>
