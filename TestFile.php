<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<meta name="author" content="your name">
		<meta name="description" content="Briefly describe your web page her ">
		<meta name="keywords" content="type keywords/ phrases that searchers may use to search for your contents.">
		<title>HTML Document Structure</title>
		<link rel="stylesheet" href="">
		<style>
			body{
				background-color:white;
				text-align:center;
			}
			header,footer{
				display:block;
				height:100px;
				border:2px solid white;
				background-color:gray;
				color:white;
			}
			main{
				background-color:white;
				height:400px;
			}
			header,main,footer{
				width:40%;
				margin: 0 auto;
			}
			aside{
				display:block;
				width:32%;
				float:left;
				height:98%;
				background-color:gray;
				color:white;
				margin:4px 0;
			}
			section{
				display:block;
				width:68%;
				float:right;
			}
			article{
				background-color:silver;
				height:180px;
				border:2px solid white;
				padding-top:10px;
				margin:4px 0 4px 4px;
			}
			.clear-fix{
				clear:both;
			}		
		</style>
	</head>
	<body>
		<header>
			<h2>Header Section</h2>
		</header>
		<main class="clear-fix">
			<aside>
			 <h2>Aside section</h2>
			</aside>
			<section>
				<article>
					<h2>Article 1 </h2>
				</article>
				<article>
					<h2>Article 2 </h2>
				</article>
			</section>
		</main>	
		<footer>
			<h2>Footer section</h2>
			<nav>
				<h4>&copy;copyright</h4>
			</nav>
		</footer>
	</body>
</html>