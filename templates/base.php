<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Simply news app</title>
		<link rel="stylesheet" href=".././public/css/main.min.css" />
	</head>
	<body>
		<nav class="nav">
			<div class="nav__logo">
				<img src="./../public/icon/book.svg" alt="book" class="nav__logo" />
				<p class="nav__logo-text">News</p>
			</div>
			<div class="nav__list">
				<div class="nav__item">
					<a href="/" class="nav__item-link">Home</a>
				</div>
			<?php if(empty($_SESSION['user'])): ?>
				<div class="nav__item">
					<a href="/login" class="nav__item-link">Log In</a>
				</div>
				<div class="nav__item">
					<a href="/signup" class="nav__item-link">Sign Up</a>
				</div>
			<?php else: ?>
				<div class="nav__item">
					<a href="/news-create" class="nav__item-link">Create News</a>
				</div>
				<div class="nav__item">
					<a href="/news-list" class="nav__item-link">List News</a>
				</div>
				<div class="nav__item">
					<a href="/logout" class="nav__item-link">Log Out</a>
				</div>
			<?php endif; ?>
			</div>
		</nav>
		<header class="header">
			<h1 class="header__title">
				<?php echo "{$params['header']}" ?? ''; ?>
			</h1>
		</header>
		<div class="wrapper">
			<main>
				<?php
                    include_once("./templates/pages/{$page}.php")
                ?>
			</main>
		</div>
		<footer class="footer">This is Footer</footer>
	</body>
</html>
