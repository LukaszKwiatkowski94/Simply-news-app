<section class="section">
	<div class="form-container">
		<div class="form-card">
			<!-- Form Title -->
			<h2 class="form__title">Sign Up</h2>

			<!-- Signup Form -->
			<form action="/signup" method="post">
				<!-- Username Field -->
				<div class="form__group">
					<label for="username" class="form__label">Username</label>
					<input 
						type="text" 
						name="username" 
						id="username" 
						class="form__input"
						placeholder="Choose a username"
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
						placeholder="Choose a strong password"
						required
						minlength="6"
					/>
				</div>

				<!-- Name Field -->
				<div class="form__group">
					<label for="name" class="form__label">First Name</label>
					<input 
						type="text" 
						name="name" 
						id="name" 
						class="form__input"
						placeholder="Your first name"
						required
					/>
				</div>

				<!-- Surname Field -->
				<div class="form__group">
					<label for="surname" class="form__label">Last Name</label>
					<input 
						type="text" 
						name="surname" 
						id="surname" 
						class="form__input"
						placeholder="Your last name"
						required
					/>
				</div>

				<!-- Submit Button -->
				<button type="submit" class="form__submit">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
						<circle cx="8.5" cy="7" r="4"></circle>
						<line x1="20" y1="8" x2="20" y2="14"></line>
						<line x1="23" y1="11" x2="17" y2="11"></line>
					</svg>
					Sign Up
				</button>
			</form>

			<!-- Footer Link -->
			<div class="form__footer">
				<p class="form__footer-text">
					Already have an account? 
					<a href="/login" class="form__footer-link">Log In</a>
				</p>
			</div>
		</div>
	</div>
</section>