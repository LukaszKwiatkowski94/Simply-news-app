<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $params['header'] ? 'Simply News App - ' . $params['header'] : 'Simply News App'; ?></title>
	
	<!-- Preconnect for faster font loading -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	
	<!-- Google Fonts - Inter -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	
	<!-- Main CSS -->
	<link rel="stylesheet" href="/public/css/main.min.css" />
	
	<!-- Favicon (optional) -->
	<link rel="icon" type="image/svg+xml" href="/public/icon/book.svg" />
</head>
<body>
	<!-- Navigation -->
	<nav class="nav">
		<div class="wrapper">
			<div class="nav__container">
				<div class="nav__wrapper">
					<!-- Logo -->
					<a href="/" class="nav__logo">
						<div class="nav__logo-icon">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
								<path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
							</svg>
						</div>
						<span class="nav__logo-text">Simply News</span>
					</a>

					<!-- Desktop Navigation -->
					<ul class="nav__list">
						<li class="nav__item">
							<a href="/" class="nav__item-link">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
									<polyline points="9 22 9 12 15 12 15 22"></polyline>
								</svg>
								Home
							</a>
						</li>
						
						<?php if(!$this->user->isLoggedIn()): ?>
							<!-- Not logged in -->
							<li class="nav__item">
								<a href="/login" class="nav__item-link">
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
										<polyline points="10 17 15 12 10 7"></polyline>
										<line x1="15" y1="12" x2="3" y2="12"></line>
									</svg>
									Log In
								</a>
							</li>
							<li class="nav__item nav__item--cta">
								<a href="/signup" class="nav__item-link">
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
										<circle cx="8.5" cy="7" r="4"></circle>
										<line x1="20" y1="8" x2="20" y2="14"></line>
										<line x1="23" y1="11" x2="17" y2="11"></line>
									</svg>
									Sign Up
								</a>
							</li>
						<?php else: ?>
							<!-- Logged in -->
							<!-- Categories Dropdown -->
							<li class="nav__item nav__item--dropdown">
								<button class="nav__item-link nav__item-link--dropdown" aria-haspopup="true" aria-expanded="false">
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
										<path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
									</svg>
									Categories
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px;">
										<polyline points="6 9 12 15 18 9"></polyline>
									</svg>
								</button>
								<ul class="nav__dropdown-menu">
									<?php
										$categoriesModel = new \APP\Models\CategoriesModel();
										$categories = $categoriesModel->list();
										foreach ($categories as $category):
											if ($category->isActive()):
									?>
									<li>
										<a href="/categories?cat=<?php echo $category->getId(); ?>" class="nav__dropdown-link">
											<?php echo htmlspecialchars($category->getName()); ?>
										</a>
									</li>
									<?php
											endif;
										endforeach;
									?>
								</ul>
							</li>
							<!-- Account Dropdown -->
							<li class="nav__item nav__item--dropdown">
								<button class="nav__item-link nav__item-link--dropdown" aria-haspopup="true" aria-expanded="false">
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
										<circle cx="12" cy="7" r="4"></circle>
									</svg>
									Account
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px;">
										<polyline points="6 9 12 15 18 9"></polyline>
									</svg>
								</button>
								<ul class="nav__dropdown-menu">
									<li><a href="/account" class="nav__dropdown-link">My Profile</a></li>
									<li><a href="/account/change-password" class="nav__dropdown-link">Change Password</a></li>
									<?php if($this->user->isAdmin()): ?>
										<li><hr class="nav__dropdown-divider"></li>
										<li><a href="/admin" class="nav__dropdown-link">Admin Panel</a></li>
									<?php endif; ?>
									<li><hr class="nav__dropdown-divider"></li>
									<li><a href="/logout" class="nav__dropdown-link">Log Out</a></li>
								</ul>
							</li>
						<?php endif; ?>
					</ul>

					<!-- Mobile Menu Button -->
					<button class="nav__btn" aria-label="Toggle menu" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<line x1="3" y1="12" x2="21" y2="12"></line>
							<line x1="3" y1="6" x2="21" y2="6"></line>
							<line x1="3" y1="18" x2="21" y2="18"></line>
						</svg>
					</button>
				</div>

				<!-- Mobile Navigation -->
				<ul class="nav__list--mobile">
					<li class="nav__item">
						<a href="/" class="nav__item-link">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
								<polyline points="9 22 9 12 15 12 15 22"></polyline>
							</svg>
							Home
						</a>
					</li>

					<?php if(!$this->user->isLoggedIn()): ?>
						<li class="nav__item">
							<a href="/login" class="nav__item-link">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
									<polyline points="10 17 15 12 10 7"></polyline>
									<line x1="15" y1="12" x2="3" y2="12"></line>
								</svg>
								Log In
							</a>
						</li>
						<li class="nav__item">
							<a href="/signup" class="nav__item-link">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
									<circle cx="8.5" cy="7" r="4"></circle>
									<line x1="20" y1="8" x2="20" y2="14"></line>
									<line x1="23" y1="11" x2="17" y2="11"></line>
								</svg>
								Sign Up
							</a>
						</li>
					<?php else: ?>
						<!-- Categories Links Mobile -->
						<li class="nav__item">
							<button class="nav__item-link" style="background: none; border: none; cursor: pointer; width: 100%; text-align: left; padding: 0.8rem 1.6rem; display: flex; align-items: center; gap: 0.8rem;" onclick="toggleCategoriesMenu(this)">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
									<path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
								</svg>
								Categories
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: auto;">
									<polyline points="6 9 12 15 18 9"></polyline>
								</svg>
							</button>
							<ul class="mobile-categories-menu" style="display: none; max-height: 0; overflow: hidden; transition: max-height 0.3s ease; border-top: 1px solid rgba(255, 255, 255, 0.1);">
								<?php
									$categoriesModel = new \APP\Models\CategoriesModel();
									$categories = $categoriesModel->list();
									foreach ($categories as $category):
										if ($category->isActive()):
								?>
								<li>
									<a href="/categories?cat=<?php echo $category->getId(); ?>" class="nav__item-link" style="padding: 0.8rem 3.2rem; font-size: 1.4rem;">
										<?php echo htmlspecialchars($category->getName()); ?>
									</a>
								</li>
								<?php
										endif;
									endforeach;
								?>
							</ul>
						</li>
						<!-- Account Links Mobile -->
						<li class="nav__item">
							<a href="/account" class="nav__item-link">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
									<circle cx="12" cy="7" r="4"></circle>
								</svg>
								My Profile
							</a>
						</li>
						<li class="nav__item">
							<a href="/account/change-password" class="nav__item-link">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
									<path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
								</svg>
								Change Password
							</a>
						</li>
						<?php if($this->user->isAdmin()): ?>
							<li class="nav__item">
								<a href="/admin" class="nav__item-link">
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<circle cx="12" cy="12" r="1"></circle>
										<circle cx="12" cy="1" r="1"></circle>
										<circle cx="12" cy="23" r="1"></circle>
										<circle cx="1" cy="12" r="1"></circle>
										<circle cx="23" cy="12" r="1"></circle>
										<path d="M5.64 5.64l.707.707"></path>
										<path d="M18.36 5.64l-.707.707"></path>
										<path d="M5.64 18.36l.707-.707"></path>
										<path d="M18.36 18.36l-.707-.707"></path>
									</svg>
									Admin Panel
								</a>
							</li>
						<?php endif; ?>
						<li class="nav__item">
							<a href="/logout" class="nav__item-link">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
									<polyline points="10 17 15 12 10 7"></polyline>
									<line x1="15" y1="12" x2="3" y2="12"></line>
								</svg>
								Log Out
							</a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Header -->
	<!-- <header class="header">
		<div class="wrapper">
			<h1 class="header__title">
				<?php echo $params['header'] ?? 'Main Page'; ?>
			</h1>
			<?php if(isset($params['subtitle'])): ?>
				<p class="header__subtitle"><?php echo $params['subtitle']; ?></p>
			<?php endif; ?>
		</div>
	</header> -->

	<!-- Main Content -->
	<div class="wrapper">
		<main>
			<?php
				$pagePath = __DIR__ . "/pages/{$templatePage}.php";
				if (file_exists($pagePath)) {
					include_once($pagePath);
				} else {
					echo '<div style="padding: 2rem; color: red; font-size: 1.8rem;">';
					echo "Błąd: Plik szablonu nie znaleziony: {$templatePage}";
					echo '</div>';
				}
			?>
		</main>
	</div>

	<!-- Footer -->
	<footer class="footer">
		<div class="wrapper">
			<div class="footer__container">
				<p class="footer__text">Simply News App © <?php echo date('Y'); ?></p>
			</div>
		</div>
	</footer>

	<!-- Dropdown Menu Styles -->
	<style>
		/* Dropdown Menu Container */
		.nav__item--dropdown {
			position: relative;
		}

		/* Dropdown Button */
		.nav__item-link--dropdown {
			background: none;
			padding: 0.8rem 1.2rem;
			border: none;
			cursor: pointer;
			display: flex;
			align-items: center;
		}

		/* Dropdown Menu */
		.nav__dropdown-menu {
			position: absolute;
			top: calc(100% + 0.8rem);
			right: 0;
			background-color: rgba(255, 255, 255, 0.15);
			backdrop-filter: blur(16px) saturate(180%);
			-webkit-backdrop-filter: blur(16px) saturate(180%);
			border: 1px solid rgba(255, 255, 255, 0.2);
			border-radius: 1.2rem;
			list-style: none;
			padding: 0.8rem 0;
			min-width: 20rem;
			box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
			opacity: 0;
			visibility: hidden;
			transform: translateY(-10px);
			transition: all 0.3s ease;
			z-index: 1001;
		}

		.nav__item--dropdown.active .nav__dropdown-menu {
			opacity: 1;
			visibility: visible;
			transform: translateY(0);
		}

		/* Dropdown Link */
		.nav__dropdown-link {
			display: block;
			padding: 1.2rem 2rem;
			color: #ffffff;
			text-decoration: none;
			font-size: 1.6rem;
			transition: background-color 0.2s ease, color 0.2s ease;
		}

		.nav__dropdown-link:hover {
			background-color: rgba(255, 255, 255, 0.1);
			color: rgba(255, 255, 255, 0.9);
		}

		/* Dropdown Divider */
		.nav__dropdown-divider {
			margin: 0.8rem 0;
			border: none;
			border-top: 1px solid rgba(255, 255, 255, 0.1);
		}

		/* Mobile menu adjustments */
		@media (max-width: 767px) {
			.nav__dropdown-menu {
				position: static;
				opacity: 0;
				visibility: hidden;
				transform: none;
				background-color: rgba(255, 255, 255, 0.05);
				max-height: 0;
				overflow: hidden;
				transition: all 0.3s ease;
				border: none;
				border-radius: 0;
				box-shadow: none;
				min-width: auto;
				margin-top: 0.8rem;
			}

			.nav__item--dropdown.active .nav__dropdown-menu {
				opacity: 1;
				visibility: visible;
				max-height: 500px;
				border-top: 1px solid rgba(255, 255, 255, 0.1);
			}

			.nav__dropdown-link {
				padding: 1rem 2rem;
				font-size: 1.4rem;
			}
		}
	</style>

	<!-- JavaScript -->
	<script src=".././public/js/openMenu.min.js"></script>
	<script>
		// Dropdown menu functionality - works for all dropdowns
		document.addEventListener('DOMContentLoaded', function() {
			const dropdownItems = document.querySelectorAll('.nav__item--dropdown');
			
			dropdownItems.forEach(dropdownItem => {
				const dropdownButton = dropdownItem.querySelector('.nav__item-link--dropdown');
				const dropdownMenu = dropdownItem.querySelector('.nav__dropdown-menu');

				if (dropdownButton && dropdownMenu) {
					// Toggle dropdown on button click
					dropdownButton.addEventListener('click', function(e) {
						e.preventDefault();
						dropdownItem.classList.toggle('active');
						dropdownButton.setAttribute('aria-expanded', 
							dropdownButton.getAttribute('aria-expanded') === 'false' ? 'true' : 'false'
						);
					});

					// Close dropdown when clicking a link
					const dropdownLinks = dropdownMenu.querySelectorAll('.nav__dropdown-link');
					dropdownLinks.forEach(link => {
						link.addEventListener('click', function() {
							dropdownItem.classList.remove('active');
							dropdownButton.setAttribute('aria-expanded', 'false');
						});
					});

					// Close dropdown when clicking outside
					document.addEventListener('click', function(e) {
						if (!dropdownItem.contains(e.target)) {
							dropdownItem.classList.remove('active');
							dropdownButton.setAttribute('aria-expanded', 'false');
						}
					});

					// Close on Escape key
					document.addEventListener('keydown', function(e) {
						if (e.key === 'Escape') {
							dropdownItem.classList.remove('active');
							dropdownButton.setAttribute('aria-expanded', 'false');
						}
					});
				}
			});
		});

		// Mobile Categories Menu Toggle
		function toggleCategoriesMenu(button) {
			const menu = button.nextElementSibling;
			const isOpen = menu.style.display === 'block';
			
			if (isOpen) {
				menu.style.display = 'none';
				menu.style.maxHeight = '0';
			} else {
				menu.style.display = 'block';
				menu.style.maxHeight = menu.scrollHeight + 'px';
			}
			
			// Close when clicking link
			const links = menu.querySelectorAll('a');
			links.forEach(link => {
				link.addEventListener('click', function() {
					menu.style.display = 'none';
					menu.style.maxHeight = '0';
				});
			});
		}
	</script>
</body>
</html>