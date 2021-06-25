$("document").ready(function() {

    /* When DOM is fully formed */
    $("li.page-num").first().addClass("current");
    var total_pages = $("#total_pages").data("id");
    /* Event delegation for previous and next classes */
    $("#pagination").on("click", [".previous", ".next"], function(e) {
        e.preventDefault();
        var target = e.target;
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
    $(".page-num").click(function() {
        var page_num = $(this).on("click").data("id");
        $(".page-num").removeClass("current");
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

    function nextPage(page_num, total_pages) {
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

    function previousPage(page_num) {
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
    $(".load-more").click(function() {
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

    function aJax(page_num) {
        $.ajax({
            url: "/spexproject/includes/posts-pagination.php",
            type: "POST",
            data: {
                "page_num": 1,
                "page_num": page_num
            },
            success: function(data) {
                if (window.innerWidth < 769) {
                    $("#posts_thumbnails").append(data);
                } else {
                    $("#posts_thumbnails").html(data);
                }

            }
        });
    }
});