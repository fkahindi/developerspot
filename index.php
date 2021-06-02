<?php 
if(!isset($_SESSION)){
  session_start();
} 
require_once __DIR__ .'/config.php';
include __DIR__ .'/admin/includes/posts_functions.php';
include __DIR__ .'/admin/includes/admin_functions.php';
	$published_post_ids = getThreeLatestPublishedPostIds();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- head section -->
  <?php include_once __DIR__ .'/templates/head.html.php'; ?>
  <title>Developerspot: Building dynamic responsive webpages powered by PHP </title> 
    <meta name="description" content="Building dynamic responsive webpages powered by PHP" />
    <meta name="keywords" content="creating, html, webpage, form, javascript, elements, language, mysql,  designing, development, developerspot, blog, build, technologies, tutorials"/>
    <!-- Facebook OG metas -->
    <meta property="og:url"                content="<?php echo $url;?>" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Developerspot: Building dynamic and interactive websites" />
    <meta property="og:description"        content="Building dynamic, interactive websites powered by PHP and MySql" />
    <meta property="og:image"              content="<?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01.jpg" />
    <meta property="fb:app_id"				content="502152493814762"/>
  <style>
  html,body, div, span, applet, object, iframe,
  h1, h2, h3, h4, h5, h6, p, blockquote, pre,
  a, abbr, acronym, address, big, cite, code,
  del, dfn, em, img, ins, kbd, q, s, samp,
  small, strike, strong, sub, sup, tt, var,
  b, u, i, center,dl, dt, dd, ol, ul, li,
  fieldset, form, label, legend,
  table, caption, tbody, tfoot, thead, tr, th, td,
  article, aside, canvas, details, embed,
  figure, figcaption, footer, header, hgroup,
  menu, nav, output, ruby, section, summary,
  time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
  }
  article, aside, details, figcaption, figure,
  footer, header, hgroup, menu, nav, section {
    display: block;
  }
  </style>
      
  <?php include_once __DIR__ .'/templates/head-resources.html.php'; ?>
  <link rel="canonical" href="https://www.developerspot.co.ke/">
      <!-- JSON-LD markup generated by Google Structured Data Markup Helper. -->
      <script type="application/ld+json">
        {
          "@context": "http://schema.org/",
          "@type": "WebSite",
          "url": "https://www.developerspot.co.ke",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "{search_term_string}",
            "query-input": "required name=search_term_string"
          }
        }
      </script>
  </head>
	<body>
      <header class="grid-wrapper">
        <?php require_once __DIR__ . '/templates/header.html.php';?>
        <?php include __DIR__ .'/templates/social-icons-links.php';?>
      </header>
      <main class="class="grid-wrapper">
        <section class="section-one">
          <div class="welcome"> 
          <h1>Bulding Websites</h1> 
            
            <p>What does it take to build a website? Well, it depends on what you want to achieve, and the tools at hand. But a grasp of core technologies can go a long way.</p> 
            <p>Take for example this blog site, of course HTML and CSS are the building blocks of web development. But, there's some JavaScript, some jQuery and Ajax added there. Then at the back end, powered by PHP and MySQL. I'm not saying these are the only technologies one can use to build a website, but at least they are the ones I used here. At Developerspot, I focus on these.</p>
          </div>
        </section>
        <section class="section-two">  
          <div class="html-css">
            <h2>HTML and CSS</h2>
            <p>HTML and CSS are two fundumental building blocks of web pages. HTML (Hypertext Markup Language) is used in <em>marking up</em> the elements the browser should display on the web page. CSS (Cascading Style Sheet) defines style rules on <em>how</em> the browser should display the marked up elements. While HTML is focused on the content to be displayed on the web page, CSS is about the presentation of the  content. </p>
            <a href="<?php echo BASE_URL ?>topic/html"><button>Visit tutorials</button></a>
          </div>
          <div class="browse-topics">
          <h3>Browse Topics</h3>
            <?php include __DIR__ . '/templates/published_posts_by_topics.html.php';?>				
          </div>
        </section>
        <section class="section-three">
          <div class="card">
            <h3 class="card-title">Web development services</h3>
            <picture>
              <source type="image/webp" media="(max-width: 599px)" srcset="<?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-sm.webp 1x">
              <source type="image/webp" media="(max-width: 1199px)" srcset="<?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-md.webp 1x, <?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-md@2x.webp 2x">
              <source type="image/webp" media="(min-width: 1200px)" srcset="<?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-lg.webp 1x, <?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-lg@2x.webp 2x">
              <source type="image/jpeg" media="(max-width: 599px)" srcset="<?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-sm.jpg 1x, <?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-sm@2x.jpg 2x">
              <source type="image/jpeg" media="(max-width: 1199px)" srcset="<?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-md.jpg 1x">
              <source type="image/jpeg" media="(min-width: 1200px)" srcset="<?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-lg.jpg 1x, <?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-lg@2x.jpg 2x">  
              <img src="<?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01.jpg" alt="profile-image" loading="lazy" width="75px" height="80px" data-pin-nopin="1"/>
            </picture>
            <p>Hey, I'm Francis Disii, a web developer and blogger. I help people build efficient, light-weight SEO friendly websites. On this site I also blog about how to be a web developer. You need a website developed for you? Reach out!</p>
            <div class="contact-media-links">
              <a href="http://twitter.com/developerspotke" target="_blank" class="fa fa-twitter"></a>
              <a href="https://www.linkedin.com/in/francis-kahindi-43871440" class="fa fa-linkedin" target="_blank"></a>
              <a href="https://web.facebook.com/developerspotKe" target="_blank" class="fa fa-facebook"></a>
            </div >
            
            <button><a href="<?php echo BASE_URL ?>templates/contact-me-form.html.php">Contact</a></button>
          </div>
          <div class=php-mysql>
            <h2>PHP and MySQL</h2>
            <p>PHP and MysQL are back end technologies that power many dynamic websites. PHP (Hypertext Preprocessor) is a server scripting language. Using PHP you can program a web server on how it should deliver web content.</p> 
            <p>MySQL on the other hand, is a server-based relational database management system. You can use it to store large amounts of data resources; from product items on an e-commerce site, to user profiles on a user management system. PHP and MySql integrates well over the web and many developers use the two to serve dynamic web pages.  </p>
            <a href="<?php echo BASE_URL ?>topic/php"><button>Visit tutorials</button></a>
          </div>
        </section>
        <section class="section-four">
          <div class="javascript">
            <h2>JavaScript</h2>
            <p>JavaScript is an essential part of front end web development. It has been widely used as a scripting language to add interactivity to web pages. Over the years, it has evolved  to a full-fledged programming language for both front end  and back end environments. You can use the language in its pure form or its libraries. There are also JavaScript based frameworks that hasten application development.   </p>
            <a href="<?php echo BASE_URL ?>topic/javascript"><button>Visit tutorials</button></a>
          </div>
          </section>     
        <section class="section-five">
          <div class="posts-section border-not-last-child-div">
            <h3>Latest Tutotials</h3>			
            <?php foreach($published_post_ids as $post_id): ?>
              
              <?php $post = getPostById($post_id['post_id']) ?>
                          
              <div class="posts-snippets">         
                <?php echo (!empty($post['image'])? '<img src="'.$post['image'].'" loading="lazy" width="100" height="90" alt="'.(!empty($post['image_caption'])? $post['image_caption']:'').'" class="post-thumb-nail">':'')?>
                <h4><a href="<?php echo BASE_URL ?>posts/<?php echo $post_id['post_id'] ?>/<?php echo $post['post_slug'] ?>"> <?php echo htmlspecialchars_decode($post['post_title']) ?></a></h4>
                <p> <?php echo getFirstParagraphPostById($post_id['post_id']) ?>
                <a href="<?php echo BASE_URL ?>posts/<?php echo $post_id['post_id'] ?>/<?php echo $post['post_slug'] ?>"><strong>Read more...</strong></a></p>
              </div>
          <?php endforeach ?>
          </div>	
        </section>
      </main>
      <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> 
      
      <script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
      <script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
          <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"
          ></script>
          <!--  
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
          <script src="https://www.developerspot.co.ke/resources/js/page-control.js"></script>
      -->
     

      <script>
      /* Facabook */
        document.getElementById('shareBtn').onclick = function() {
          FB.ui({
            display: 'popup',
            method: 'share',
            href="<?php echo $url;?>",
          }, function(response){});
        }
      </script>
      <footer class="grid-wrapper">
        <?php include __DIR__ .'/templates/social-icons-links.php';?>
        <?php include __DIR__ .'/templates/footer.html.php'?>
      </footer>		
	</body>
</html>