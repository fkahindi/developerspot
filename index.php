<?php 
session_start(); 
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
  <title>Developerspot: Building dynamic and interactive websites </title> 
    <meta name="description" content="Building dynamic, interactive websites powered by PHP" />
    <meta name="keywords" content="build website, programming, language, scripting, server,front end, PHP, MySql, HTML, CSS, JavaScript, websites, web pages."/>
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
    [ {
      "@context" : "http://schema.org",
      "@type" : "Article",
      "name" : "Creating a Webpage: Designing a Web Form",
      "author" : {
        "@type" : "Person",
        "name" : "Fkahindi"
      },
      "datePublished" : "2020-11-19",
      "image" : "https://www.developerspot.co.ke/resources/images/reservation-form.png",
      "articleSection" : "Web forms are common on web pages. They are a means of interacting with web users and help in collecting views or information from them. In this installment we are going to create a web form for placing reservation at our in progress Mara Resort webpage. At the end of t...",
      "url" : "https://www.developerspot.co.ke/posts/7/creating-a-webpage-designing-a-web-form",
      "publisher" : {
        "@type" : "Organization",
        "name" : "DevelopersPot"
      }
    }, {
      "@context" : "http://schema.org",
      "@type" : "Article",
      "name" : "Creating a Webpage: Designing a Responsive Page",
      "author" : {
        "@type" : "Person",
        "name" : "Fkahindi"
      },
      "datePublished" : "2020-08-24",
      "image" : "https://www.developerspot.co.ke/resources/images/responsive-webpage.png",
      "articleSection" : "This is a second part of a series Creating a Webpage. In the fist part, we learned how to structure an HTML document using both semantic and presentation HTML elements. In that post we defined these elements and why we are using them. If you did not...",
      "url" : "https://www.developerspot.co.ke/posts/6/creating-a-webpage-designing-a-responsive-page",
      "publisher" : {
        "@type" : "Organization",
        "name" : "DevelopersPot"
      }
    }, {
      "@context" : "http://schema.org",
      "@type" : "Article",
      "name" : "Creating a Webpage: HTML Document Structure",
      "author" : {
        "@type" : "Person",
        "name" : "Fkahindi"
      },
      "datePublished" : "2020-06-25",
      "image" : "https://www.developerspot.co.ke/resources/images/html-doc-structure.png",
      "articleSection" : "In this series of posts, I'm going to show you how to create a webpage and possibly you can customize and host it online. We are going to cover most of the HTML elements you will likely need in a w...",
      "url" : "https://www.developerspot.co.ke/posts/5/creating-a-webpage-html-document-structure",
      "publisher" : {
        "@type" : "Organization",
        "name" : "DevelopersPot"
      }
    } ]
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
            
            <p>There is an overwhelming choice of technologies available to help anyone build a website. You may not have to be a tech-suvvy to build one. Infact, there are a number of Content Management Systems out there that can help you build one in minutes. However, to be build a secure, efficient, professional  website you need a grasp of the fundamentals.</p> 
            <p>Take for example this blog site, for it to be functional as it is, it involves various components interacting seemlesly to deliver the content. Of course HTML and CSS are the brick and mortar of web design, but there are some JavaScript, some JQuery and Ajax added there. Then at the back end, powered by PHP and MySql. I'm not saying these are the only technologies one can use to be build a website, but at least they are the ones I used here. At Developerspot we focus on these. </p>
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
              <source type="image/webp" media="(max-width: 599px)" srcset="<?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-sm.webp 1x, <?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-sm@2x.webp 2x">
              <source type="image/webp" media="(max-width: 1199px)" srcset="<?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-md.webp 1x, <?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-md@2x.webp 2x">
              <source type="image/webp" media="(min-width: 1200px)" srcset="<?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-lg.webp 1x, <?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-lg@2x.webp 2x">
              <source type="image/jpg" media="(max-width: 599px)" srcset="<?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-sm.jpg 1x, <?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-sm@2x.jpg 2x">
              <source type="image/jpg" media="(max-width: 1199px)" srcset="<?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-md.jpg 1x, <?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-md@2x.jpg 2x">
              <source type="image/jpg" media="(min-width: 1200px)" srcset="<?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-lg.jpg 1x, <?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01-lg@2x.jpg 2x">    
              <img src="<?php echo BASE_URL ?>resources/photos/contact-me/franciskahindi-01.jpg" alt="profile-image" loading="lazy" width="75" height="80" data-pin-nopin="0" />
            </picture>
            <p>Hey, I'm Francis Disii, a web developer and blogger. I help people build efficient, light-weight SEO friendly websites. On this site I also blog about how to be a web developer. You need a website developed for you? Reach out!</p>
            <div class="contact-media-links">
              <a href="http://twitter.com/developespotke" target="_blank" class="fa fa-twitter"></a>
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
                <?php echo (!empty($post['image'])? '<img src="'.$post['image'].'" loading="lazy" width="100" alt="'.(!empty($post['image_caption'])? $post['image_caption']:'').'" class="post-thumb-nail">':'')?>
                <h4><a href="<?php echo BASE_URL ?>posts/<?php echo $post_id['post_id'] ?>/<?php echo $post['post_slug'] ?>"> <?php echo htmlspecialchars_decode($post['post_title']) ?></a></h4>
                <p> <?php echo getFirstParagraphPostById($post_id['post_id']) ?>
                <a href="<?php echo BASE_URL ?>posts/<?php echo $post_id['post_id'] ?>/<?php echo $post['post_slug'] ?>"><em>Read more...</em></a></p>
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
      <script>window.twttr = (function(d, s, id) {
        /* Twitter */
       /*  var js, fjs = d.getElementsByTagName(s)[0],
          t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function(f) {
          t._e.push(f);
        };

        return t;
      }(document, "script", "twitter-wjs")); */
      </script>

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