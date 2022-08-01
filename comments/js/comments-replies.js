$("document").ready(() => {
    "use strict";
    /*
     *	Scripts to manage user comments on articles
     * Using the parent comments-container for events delegation
     */
    const path = "/spexproject/comments/includes/comments_functions.php";
    const method = "POST";

    $("#comments-container").on("click", [".submit_comment", ".post_reply", ".reply-btn", ".reply-thread", ".more-comments"], (e) => {
        e.preventDefault();
        const target = e.target;
        let comment_id = parseInt(target.id.match(/\d+/));
        switch (target.className.toLowerCase()) {
            case "submit_comment":
                submitComment();
                break;
            case "reply-btn":
                showReplyForm(comment_id);
                break;
            case "post_reply":
                postReply(comment_id);
                return false;
            case "reply-thread":
                displayReplyThread(comment_id);
                break;
            case "more-comments":
                loadMoreComments();
                break;
            default:
                /* do nothing */
        }
    });

    const submitComment = () => {
        let user_id = $("#user_id").val();
        let page_id = $("#page_id").val();
        let comment = $("#comment").val();

        $("#comment").val("");

        if (comment === "") {
            return false;
        }
        if (user_id === "") {
            /* set comment cookies and call login form */
            let commentCookie = "commentCookie";
            let pageId = "pageId";
            setCookie(commentCookie, comment);
            setCookie(pageId, page_id);

            /* for localhost */
            return window.location.href = "/spexproject/login";
            /* for online server
            return window.location.href="https://www.developerspot.co.ke/login";
            */

        }
        document.cookie = "commentCookie=; path=/; max-age=0";
        document.cookie = "pageId=; path=/; max-age=0";
        document.cookie = "userId=; path=/; max-age=0";
        let data = {
            "submit_comment": 1,
            "user_id": user_id,
            "page_id": page_id,
            "body": comment,
        }
        let res = (response) => {

            $("#comments-area").prepend(response);

            comment = "";
        }
        aJax(data, res);
    }

    /** Scripts to manage replies to comments on articles **/

    const showReplyForm = (comment_id) => {
        /* When user clicks reply link to add a reply under user's comment */
        let reply_form = $("form#comment_reply_form_" + comment_id);
        let reply_button = $("#reply_btn_" + comment_id);
        reply_form.toggle(100);
        if (reply_form.length != 0) {

            $("#reply_textarea_" + comment_id).focus();
        }

        reply_button.text(reply_button.text() == "Reply" ? "Cancel" : "Reply");
    }


    const postReply = (comment_id) => {
        /*Posting a reply */
        let reply_textarea = $("#post_reply_" + comment_id).siblings(".reply-textarea");
        let reply_text = $("#post_reply_" + comment_id).siblings("#reply_textarea_" + comment_id).val();
        let user_id = $("#post_reply_" + comment_id).siblings(".reply_form_user_id").val();


        reply_textarea.val("");

        if (reply_text === "") {
            return false;
        }
        if (user_id === "" || user_id === null) {
            /* set reply cookies and call login form */
            let replyCookie = "replyCookie";
            let commentIdCookie = "commentIdCookie";

            setCookie(replyCookie, reply_text);
            setCookie(commentIdCookie, comment_id);

            return window.location.href = "/spexproject/login";
        }
        document.cookie = "replyCookie=; path=/; max-age=0";
        document.cookie = "commentIdCookie=; path=/; max-age=0";

        let data = {
            "post_reply": 1,
            "user_id": user_id,
            "comment_id": comment_id,
            "reply_text": reply_text
        }
        let resFunc = (data) => {
            $(".replies_container_" + comment_id).children(".replies_by_ajax").prepend(data);

            $("form#comment_reply_form_" + comment_id).hide();
            $("#reply_btn_" + comment_id).text("Reply");
            $(".group.replies_container_" + comment_id).show(100);
            comment_id = "";
        }
        aJax(data, resFunc);

    }

    const displayReplyThread = (comment_id) => {
        /* When user clicks Replies link replies of that comment are displayed */
        let thread_reply_id = comment_id;
        const html1 = "&#9650;";
        const html2 = "&#9660;";

        $(".group.replies_container_" + thread_reply_id).toggle(100);

        $("#reply_thread_" + comment_id).text($("#reply_thread_" + comment_id).text() == convertEntities(html1) ? convertEntities(html2) : convertEntities(html1));
    }

    const loadMoreComments = () => {
        /* When user clicks Load more... */
        let page_id = $(".pagination").data("id");
        let page_no = $(".more-comments").data("id");
        let no_of_comments_per_view = $(".comments-per-view").data("id");
        let number_of_pages = $("#num-of-pages").data("id");
        let offset = 0;
        let limit = "";

        if (page_no !== 0) {
            offset = (page_no - 1) * no_of_comments_per_view;
        } else {
            return false;
        }
        limit = "LIMIT " + offset + ", " + no_of_comments_per_view;

        let data = {
            "load_more": 1,
            "page_id": page_id,
            "limit": limit
        }
        let resFunc = (data) => {
            page_no = page_no + 1;
            $("#comments-area").append(data);

            $(".more-comments").data("id", page_no);

            if (page_no > number_of_pages) {
                $(".more-comments").hide();
            }
        }
        aJax(data, resFunc);
    }

    const convertEntities = (html) => {
        let el = document.createElement("div");
        el.innerHTML = html;
        return el.firstChild.data;
    }
    const aJax = async(data, resFunc) => {
        await $.ajax({
            url: path,
            type: method,
            data: data,
            success: resFunc
        });
    }
    const setCookie = (cookieName, value) => {
        let cookie = cookieName + "=" + encodeURIComponent(value);
        cookie += "; path=/; sameSite=Strict; secure";
        document.cookie = cookie;
    }
});
/* For online server, run the following command on the terminal to get minified, compressed and mangled file:
 "terser comments-replies.js --compress --mangle --output comments-replies.min.js"
*/