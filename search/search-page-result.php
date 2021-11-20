<?php
session_start();
require_once __DIR__ . '/../config.php';

if (isset($_GET['q']) && (!empty($_GET['q']))) {
	include __DIR__ . '/../../includes_devspot/DatabaseConnection.php';

	$query = htmlspecialchars($_GET['q']);

	/* //Seperating words and appending the metaphone of each word with a space */
	$search = explode(' ', $query);
	$search_term = '';
	foreach ($search as $word) {
		//$search_term .= metaphone($word).' ';
		$search_term .= $word . ' ';
	}
	/* //prepare variables for prepared statement */
	$search_term1 = $search_term;
	$search_term2 = '%' . $search_term . '%';

	/* $stmt = $pdo->prepare("SELECT post_title, SUBSTRING(post_body, GREATEST(1,LOCATE(?,post_body)-10),LEAST(25, LENGTH(post_body)-GREATEST(1,LOCATE(?,post_body)-10)))
	text FROM `posts` WHERE metaphoned LIKE ? AND published=1"); */

	$stmt = $pdo->prepare("SELECT post_id, post_title, post_slug, meta_description FROM `posts` WHERE post_title LIKE ? OR post_body LIKE ? AND published=1");

	$stmt->execute([$search_term1, $search_term2]);

	$res = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- head section -->
	<?php include_once __DIR__ . '/../templates/head.html.php'; ?>
	<title>Search Developerspot - Results</title>
	<style>
		html,
		body,
		div,
		span,
		applet,
		object,
		iframe,
		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		p,
		blockquote,
		pre,
		a,
		abbr,
		acronym,
		address,
		big,
		cite,
		code,
		del,
		dfn,
		em,
		img,
		ins,
		kbd,
		q,
		s,
		samp,
		small,
		strike,
		strong,
		sub,
		sup,
		tt,
		var,
		b,
		u,
		i,
		center,
		dl,
		dt,
		dd,
		ol,
		ul,
		li,
		fieldset,
		form,
		label,
		legend,
		table,
		caption,
		tbody,
		tfoot,
		thead,
		tr,
		th,
		td,
		article,
		aside,
		canvas,
		details,
		embed,
		figure,
		figcaption,
		footer,
		header,
		hgroup,
		menu,
		nav,
		output,
		ruby,
		section,
		summary,
		time,
		mark,
		audio,
		video {
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 100%;
			font: inherit;
			vertical-align: baseline;
		}

		article,
		aside,
		details,
		figcaption,
		figure,
		footer,
		header,
		hgroup,
		menu,
		nav,
		section {
			display: block;
		}
	</style>
	<?php include_once __DIR__ . '/../templates/head-resources.html.php'; ?>
	<style>
		.main-article {
			margin: 1em auto;
			padding: 1em 0.5em;
			background-color: transparent;
		}

		@media (max-width: 768px) {
			.main-article {
				width: 90%;
			}
		}

		@media (max-width: 599px) {
			.main-article {
				width: 100%;
				margin: 0 auto;
				padding: 0.5em;
			}
		}

		@media (min-width: 769px) {
			.main-article {
				width: 70%;
			}
		}

		@media (min-width: 992px) {
			.main-article {
				width: 60%;
			}
		}

		.posts-snippets a {
			text-decoration: underline;
			color: lightseagreen;
		}

		.posts-snippets h5 {
			color: lightseagreen;
		}

		.posts-snippets a:hover,
		.posts-snippets h5:hover {
			color: darkblue;

		}

		.posts-snippets p {
			margin: 0 1em;
			line-height: normal;
			font-size: 0.9em;
		}
	</style>
</head>

<body>
	<header class="grid-wrapper">
		<?php require_once __DIR__ . '/../templates/header.html.php'; ?>
		<?php include __DIR__ . '/search-form.php'; ?>
	</header>
	<main class="group">
		<section class="posts-section">
			<h4><?php echo count($res)?> items found for <em>"<?php echo htmlspecialchars($_GET['q']) ?>"</em></h4><hr />
			<div class="posts-snippets">
				<?php
				if (!empty($res)) {
					$counter = 1;
					foreach ($res as $row) {

				?>
						<!--Display results -->
						<h5><?= $counter ?>. <nbsp> <a href="<?php echo BASE_URL ?>posts/<?php echo $row['post_slug'] ?>"><?php echo htmlspecialchars_decode($row['post_title']) ?> </a></h5>
						<p><?php echo htmlspecialchars_decode($row['meta_description']) ?></p>

				<?php
						$counter = $counter + 1;
					}
				} else {
					echo '<h4 class="errors">No results to display</h4>';
				}
				?>
			</div>
		</section>
	</main>
	<script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
</body>

</html>