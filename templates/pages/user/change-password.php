<section class="section">
	<div class="form-container">
		<div class="form-card">
			<!-- Form Title -->
			<h2 class="form__title">Change Password</h2>

			<!-- Error Message -->
			<?php if(!empty($error)): ?>
			<div style="background-color: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 1.2rem; padding: 1.6rem; margin-bottom: 2.4rem; color: #fca5a5; font-size: 1.6rem; text-align: center;">
				<?php echo htmlspecialchars($error); ?>
			</div>
			<?php endif; ?>

			<!-- Form -->
			<form method="POST" action="/account/change-password">
				<!-- Current Password Field -->
				<div class="form__group">
					<label for="oldPassword" class="form__label">Current Password</label>
					<input 
						type="password" 
						id="oldPassword" 
						name="oldPassword" 
						class="form__input"
						required 
						placeholder="Enter your current password"
						autocomplete="current-password"
					/>
				</div>

				<!-- New Password Field -->
				<div class="form__group">
					<label for="newPassword" class="form__label">New Password</label>
					<input 
						type="password" 
						id="newPassword" 
						name="newPassword" 
						class="form__input"
						required 
						placeholder="Enter new password (min 6 characters)"
						minlength="6"
						autocomplete="new-password"
					/>
					<small style="color: rgba(255, 255, 255, 0.6); font-size: 1.4rem; display: block; margin-top: 0.4rem;">Password must be at least 6 characters long</small>
				</div>

				<!-- Confirm Password Field -->
				<div class="form__group">
					<label for="confirmPassword" class="form__label">Confirm New Password</label>
					<input 
						type="password" 
						id="confirmPassword" 
						name="confirmPassword" 
						class="form__input"
						required 
						placeholder="Confirm new password"
						minlength="6"
						autocomplete="new-password"
					/>
				</div>

				<!-- Submit Button -->
				<button type="submit" class="form__submit">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M12 1v6m0 6v6M4.22 4.22l4.24 4.24m5.08 5.08l4.24 4.24M1 12h6m6 0h6M4.22 19.78l4.24-4.24m5.08-5.08l4.24-4.24"></path>
					</svg>
					Change Password
				</button>
			</form>

			<!-- Footer Link -->
			<div class="form__footer">
				<p class="form__footer-text">
					<a href="/account" class="form__footer-link">Back to Profile</a>
				</p>
			</div>
		</div>
	</div>
</section>
