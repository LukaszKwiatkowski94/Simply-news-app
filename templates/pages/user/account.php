<section class="section">
	<div class="form-container">
		<div class="form-card">
			<!-- Profile Title -->
			<h2 class="form__title">My Profile</h2>

			<!-- Success Message -->
			<?php if(isset($_GET['success']) && $_GET['success'] === 'password_changed'): ?>
			<div style="background-color: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 1.2rem; padding: 1.6rem; margin-bottom: 2.4rem; color: #86efac; font-size: 1.6rem; text-align: center;">
				Password changed successfully!
			</div>
			<?php endif; ?>

			<!-- Profile Information -->
			<div style="margin-bottom: 3.2rem;">
				<div class="form__group" style="margin-bottom: 1.6rem;">
					<label class="form__label">Username</label>
					<p style="color: rgba(255, 255, 255, 0.9); font-size: 1.6rem; margin: 0; padding: 1.2rem; background-color: rgba(255, 255, 255, 0.05); border-radius: 1.2rem; border: 1px solid rgba(255, 255, 255, 0.1);">
						<?php echo htmlspecialchars($params['user']->username); ?>
					</p>
				</div>

				<div class="form__group" style="margin-bottom: 1.6rem;">
					<label class="form__label">First Name</label>
					<p style="color: rgba(255, 255, 255, 0.9); font-size: 1.6rem; margin: 0; padding: 1.2rem; background-color: rgba(255, 255, 255, 0.05); border-radius: 1.2rem; border: 1px solid rgba(255, 255, 255, 0.1);">
						<?php echo htmlspecialchars($params['user']->name); ?>
					</p>
				</div>

				<div class="form__group" style="margin-bottom: 1.6rem;">
					<label class="form__label">Last Name</label>
					<p style="color: rgba(255, 255, 255, 0.9); font-size: 1.6rem; margin: 0; padding: 1.2rem; background-color: rgba(255, 255, 255, 0.05); border-radius: 1.2rem; border: 1px solid rgba(255, 255, 255, 0.1);">
						<?php echo htmlspecialchars($params['user']->surname); ?>
					</p>
				</div>
			</div>

			<!-- Action Buttons -->
			<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem;">
				<a href="/account/change-password" class="form__submit" style="display: inline-flex; align-items: center; justify-content: center; gap: 0.8rem; text-decoration: none;">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<circle cx="12" cy="12" r="1"></circle>
						<path d="M12 1v6m0 6v6M4.22 4.22l4.24 4.24m5.08 5.08l4.24 4.24M1 12h6m6 0h6M4.22 19.78l4.24-4.24m5.08-5.08l4.24-4.24"></path>
					</svg>
					Change Password
				</a>
				<a href="/" class="form__submit" style="display: inline-flex; align-items: center; justify-content: center; gap: 0.8rem; text-decoration: none;">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<polyline points="15 18 9 12 15 6"></polyline>
						<path d="M20.83 15.17v-6.34A10 10 0 1 0 4 12.07"></path>
					</svg>
					Back Home
				</a>
			</div>
		</div>
	</div>
</section>
