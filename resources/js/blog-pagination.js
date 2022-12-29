$("document").ready(function() {

    /* When DOM is fully formed, prepare elements selection */
    const paging = $("#pagination");
    const total_pages = $("#total_pages").data("id");
    const page_num_class = $(".page-num");
    const load_more_class = $(".load-more");
    const post_url = '/spexproject/includes/posts-pagination.php';
    //online
    //const post_url = 'https://www.developerspot.co.ke/includes/posts-pagination.php';
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
            url: post_url,
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
/* For online server, run the following command on the terminal to get minified, compressed and mangled file:
 "terser blog-pagination.js --compress --mangle --output blog-pagination.min.js"
*/