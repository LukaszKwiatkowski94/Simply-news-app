<section class="section">
	<div class="form-container">
		<div class="form-card">
			<!-- Form Title -->
			<h2 class="form__title">Log In</h2>

			<!-- Login Form -->
			<form action="/login" method="post">
				<!-- Username Field -->
				<div class="form__group">
					<label for="username" class="form__label">Username</label>
					<input 
						type="text" 
						name="username" 
						id="username" 
						class="form__input"
						placeholder="Enter your username"
						required
						autofocus
					/>
				</div>

				<!-- Password Field -->
				<div class="form__group">
					<label for="password" class="form__label">Password</label>
					<input 
						type="password" 
						name="password" 
						id="password" 
						class="form__input"
						placeholder="Enter your password"
						required
					/>
				</div>

				<!-- Submit Button -->
				<button type="submit" class="form__submit">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
						<polyline points="10 17 15 12 10 7"></polyline>
						<line x1="15" y1="12" x2="3" y2="12"></line>
					</svg>
					Log In
				</button>
			</form>

			<!-- Footer Link -->
			<div class="form__footer">
				<p class="form__footer-text">
					Don't have an account? 
					<a href="/signup" class="form__footer-link">Sign Up</a>
				</p>
			</div>
		</div>
	</div>
</section>