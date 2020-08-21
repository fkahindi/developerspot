<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<meta name="author" content="your name">
		<meta name="description" content="Briefly describe your web page her ">
		<meta name="keywords" content="type keywords/ phrases that searchers may use to search for your contents.">
		<title>Mara Resort: A Jewel in the Jungle</title>
		<style>
			body {
              font-family: sans-serif, Helvetica;
              font-size:16px;
              color: #333;
              background-color: #C2B280;
              margin: 0; 
            }
                header, footer, main {
                width: 100%;
                margin: 0;
                padding: 0; 
            }
            aside, section, article {
                display: inline-block;
                box-sizing:border-box;
            }
            aside {
              width: 100%;
              float: none; 
            }
    @media (min-width: 900px) {
        aside {
            width: 40%;
            float: left;
            margin: 0;
            padding: 10px; 
        } 
    }
    section {
        width: 100%; 
    }
    @media (min-width: 900px) {
        section {
            width: 60%;
            float: right;
            margin: 0;
            padding: 10px; 
        } 
    }
    .group:before {
      content: '';
      display: table; }
    .group:after {
      content: '';
      display: table;
      clear: both; }
      nav {
  color: #fff;
  text-align: center;
  height: 2em; 
}
nav ul {
    list-style: none;
    padding: .5em 0;
    line-height: 1; 
}
nav ul li {
      display: inline-block;
      padding: 0 1em; 
}
a {
  text-decoration: none;
  color: #fff; }
  a:hover {
    text-weight: bold;
    color: #0a140a; }
h1 {
    color: #000;
    font-family: aclonica;
    font-size: 2em;
    text-align: center;
    padding-top: .5em;
    padding-bottom: 0; 
}
.slogan {
  font-family: Allura;
  font-size: 2em;
  text-align: center;
  padding: 0; 
}
    header nav {
        background-color: #4E9258; 
    }

    footer nav {
        background-color: #387C44; 
     }
.copyright {
  text-align: center; 
}
		</style>
	</head>
	<body>
		<header>
			<h1>The Mara Resort</h1>
			<p class="slogan">The Jewel of the Jungle</p>
            <div>
                <p>The greater Mara ecosystem encompasses areas known as the Maasai Mara National Reserve, the Mara Triangle, and several Maasai Conservancies, including Koiyaki, Lemek, Ol Chorro Oirowua, Mara North, Olkinyei, Siana, Maji Moto, Naikara, Ol Derkesi, Kerinkani, Oloirien and Kimintet.</p>
            </div>
            <nav>
				<ul><li><a href="#">Home</a></li><li><a href="#">Safaris</a></li><li><a href="#">Camping</a></li></ul>
			</nav>
		</header>
		<main class="group">
			<section class="group">
				<article>
					<h2>A Day in the Jungle</h2>
					<p>Day-trips and excursions often add a special dimension to your intinery, elevating it from a memorable holiday to the trip of a lifetime. They are often very popular, so they are best booked in advance with Expert Africa before you depart on your trip.</p>
				</article>
				<article>
					<h2>Prestine Campsite </h2>
					<p>Masai Mara National Reserve is an area of preseerved savannah wilderness in southwestern Kenya, along the Tanzanian border. Its animals include lions, cheetahs, elephants, zebras and hippos. The landscape has grassy plains and rolling hills, and is crossed by Mara and Telek rivers. </p>
				</article>
			</section>
            <aside class="group">
                <h2>Side bar</h2>   
                Side bar content will appear on the side
				of the main content on a multi-column layout 
				of a big screen device...
			</aside>
		</main>	
		<footer>
			<nav>
				<ul><li><a href="#">Home</a></li><li><a href="#">Safaris</a></li><li><a href="#">Camping</a></li></ul>
			</nav>
			<p class="copyright">&copy;Mara Resort (2020)</p>
			
		</footer>
	</body>
</html>