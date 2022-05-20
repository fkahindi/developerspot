<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    require_once __DIR__ .'/config.php';    
    $thisPage = "BLOG";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <?php require_once __DIR__ .'/templates/head.html.php'; ?>
        <link rel="canonical" href="https://www.developerspot.co.ke/blog.php">
        <title>A blogging site dedicated to building websites and web apps</title>
	    <meta name="description" content="Articles dedicated to building websites and web apps that are SEO friendly. The tutorials focuses on both server-side and front end solutions. ">
        <meta name="keywords" content="websites, app, blog, server-side, front end, php, html, javascript, css, solutions"/>
        <!-- Twitter & OG metas -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@developerspotke">
        <meta name="twitter:creator" content="@fkahindi">
        <meta property="og:url" content="<?php echo $url;?>" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="A blogging site dedicated to building websites and web apps" />
        <meta property="og:description" content="Articles dedicated to building websites and web apps that are SEO friendly. The tutorials focuses on both server-side and front end solutions." />
        <meta property="og:image" content="<?php echo BASE_URL ?>resources/images/html-doc-structure.png" />
        <meta property="fb:app_id" content="502152493814762"/>
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
        <script type="application/ld+json">
            {
            "@context": "http://schema.org/",
            "@type": "WebSite",
            "url": "https://www.developerspot.co.ke/blog",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "{search_term_string}",
                "query-input": "required name=search_term_string"
            }
            }
        </script>
        </script>
            <!-- Facebook Pixel Code -->
            <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '1970631019919003');
            fbq('track', 'PageView');
        </script>
	</head>
	<body>
        <noscript><img height="1" width="1"  class="hidden"
        src="https://www.facebook.com/tr?id=1970631019919003&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Facebook Pixel Code -->
		<header class="grid-wrapper">
            <?php require_once __DIR__ . '/templates/header.html.php';?>
            <?php include __DIR__ .'/templates/social-icons-links.php';?>
            <?php include __DIR__ .'/search/search-form.php';?>
		</header>
		<main class="group">
			<section class="posts-section border-not-last-child-div">
                <h1>Browse Articles </h1>
                <div class="intro-paragraph">
                    <p>
                        Building fast, secure, SEO-friendly web apps is no longer an option, but a requirement in today's tech world. The articles here, is an opportunity to share design ideas that you can use to incorporate into your web development projects. If it helped you, leave a feedback. 
                        Happy coding!
                    </p>
                </div>
                <div id="posts_thumbnails">

                    <?php include __DIR__.'/includes/posts-pagination.php'?>
                </div>
                <div id="pagination" class="pagination">
                    <?php if($total_pages>1): ?>
                    <ul id="total_pages" data-id="<?php echo $total_pages;?>">
                        <li class="previous"></li>
                        <?php for($i=1; $i<= $total_pages; $i++){
                        echo '<li class="page-num" data-id="'.$i.'">'.$i.'</li>';}
                        if($total_pages>1){ echo '<li class="next">Next</li>';}  
                        ?>
                    </ul>
                    <div class="load-more" data-id="1">
                        <span>Load more...</span>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                    <?php endif ?>
                    
                </div>
			</section>
		</main>
        <script src="<?php echo BASE_URL ?>resources/js/jquery-3.4.0.min.js"></script>
        <script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
        <!-- <script src="<?php //echo BASE_URL ?>resources/js/getPostThumbnails.js"></script> -->
        <footer class="grid-wrapper">
        <?php include __DIR__ .'/templates/social-icons-links.php';?>
        <?php include __DIR__ .'/templates/footer.html.php'?>
      </footer>
      <script>
        $("document").ready(function() {

            /* When DOM is fully formed, prepare elements selection */
            const paging = $("#pagination");
            const total_pages = $("#total_pages").data("id");
            const page_num_class = $(".page-num");
            const load_more_class = $(".load-more");
            $("li.page-num").first().addClass("current");

            /* Event delegation for previous and next classes */
            paging.on("click", (e) => {
                e.preventDefault();
                let target = e.target;
                switch (target.className.toLowerCase()) {
                    case "previous":
                        var page_num = $(".current").data("id") - 1;
                        $(".next").text("Next");
                        previousPage(page_num);
                        break;
                    case "next":
                        var page_num = $(".current").data("id") + 1;
                        nextPage(page_num, total_pages);
                        break;
                    default:
                        /* Do nothing */
                }
            });
            /* When user clicks a page number */
            page_num_class.click(function() {
                let page_num = $(this).data("id");
                page_num_class.removeClass("current");
                $(this).addClass("current");

                aJax(page_num);

                /* display Previous when pages chenges other than 1 */
                if (page_num !== 1) {
                    $(".previous").text("Previous");
                } else {
                    $(".previous").text("");
                }
                if (page_num < total_pages) {
                    $(".next").text("Next");
                } else {
                    $(".next").text("");
                }
            });

            const nextPage = (page_num, total_pages) => {
                if (page_num <= total_pages) {
                    aJax(page_num);
                    $("li.current").next("li").addClass("current");
                    $("li.current").prev("li").removeClass("current");
                    /* display Previous when pages chenges other than 1 */
                    if (page_num !== 1) {
                        $(".previous").text("Previous");
                    } else {
                        $(".previous").text("");
                    }
                    if (page_num == total_pages) {
                        $(".next").text("");
                    }
                } else {
                    return;
                }
            }

            const previousPage = (page_num) => {
                if (page_num >= 1) {
                    aJax(page_num);
                    $("li.current").prev("li").addClass("current");
                    $("li.current").next("li").removeClass("current");
                    /* display Previous when pages chenges other than 1 */
                    if (page_num <= 1) {
                        $(".previous").text("");
                    } else {
                        $(".previous").text("Previous");
                    }
                } else {
                    return;
                }
            }
            load_more_class.click(function() {
                var current_page_num = $(".current").data("id");
                var elem_page_num = $(this).on("click").data("id");
                if (elem_page_num < current_page_num) {
                    var page_num = current_page_num;
                } else {
                    var page_num = elem_page_num;
                }
                page_num = page_num + 1;
                if (page_num <= total_pages) {
                    aJax(page_num);
                    $(this).data("id", page_num);
                    if (page_num == total_pages) {
                        $(this).hide();
                    }
                }
            });

            const aJax = (page_num) => {
                const thumbnails = $("#posts_thumbnails");
                $.ajax({
                    url: "/spexproject/includes/posts-pagination.php",
                    type: "POST",
                    data: {
                        "page_num": page_num
                    },
                    success: (data) => {
                        if (window.innerWidth < 769) {
                            thumbnails.append(data);
                        } else {
                            thumbnails.html(data);
                        }

                    }
                });
            }
        });
      </script>
	</body>
</html>