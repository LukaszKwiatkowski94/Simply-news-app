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
	<link rel="stylesheet" href=".././public/css/main.min.css" />
	
	<!-- Favicon (optional) -->
	<link rel="icon" type="image/svg+xml" href="./../public/icon/book.svg" />
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
						
						<?php if(empty($_SESSION['user'])): ?>
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
							<li class="nav__item">
								<a href="/news-create" class="nav__item-link">
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<line x1="12" y1="5" x2="12" y2="19"></line>
										<line x1="5" y1="12" x2="19" y2="12"></line>
									</svg>
									Create News
								</a>
							</li>
							<li class="nav__item">
								<a href="/news-list" class="nav__item-link">
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
										<line x1="8" y1="6" x2="21" y2="6"></line>
										<line x1="8" y1="12" x2="21" y2="12"></line>
										<line x1="8" y1="18" x2="21" y2="18"></line>
										<line x1="3" y1="6" x2="3.01" y2="6"></line>
										<line x1="3" y1="12" x2="3.01" y2="12"></line>
										<line x1="3" y1="18" x2="3.01" y2="18"></line>
									</svg>
									List News
								</a>
							</li>
							<li class="nav__item nav__item--cta">
								<a href="/logout" class="nav__item-link">
									Log Out
								</a>
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
					
					<?php if(empty($_SESSION['user'])): ?>
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
						<li class="nav__item">
							<a href="/news-create" class="nav__item-link">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<line x1="12" y1="5" x2="12" y2="19"></line>
									<line x1="5" y1="12" x2="19" y2="12"></line>
								</svg>
								Create News
							</a>
						</li>
						<li class="nav__item">
							<a href="/news-list" class="nav__item-link">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<line x1="8" y1="6" x2="21" y2="6"></line>
									<line x1="8" y1="12" x2="21" y2="12"></line>
									<line x1="8" y1="18" x2="21" y2="18"></line>
									<line x1="3" y1="6" x2="3.01" y2="6"></line>
									<line x1="3" y1="12" x2="3.01" y2="12"></line>
									<line x1="3" y1="18" x2="3.01" y2="18"></line>
								</svg>
								List News
							</a>
						</li>
						<li class="nav__item">
							<a href="/logout" class="nav__item-link">
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
				include_once("./templates/pages/{$page}.php")
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

	<!-- JavaScript -->
	<script src=".././public/js/openMenu.min.js"></script>
</body>
</html>