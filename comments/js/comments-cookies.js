	$('document').ready(function() {
	    const getCookie = (cookieName) => {
	        let cookieArr = document.cookie.split(";");
	        for (let i = 0; i < cookieArr.length; i++) {
	            let cookiePair = cookieArr[i].split("=");
	            if (cookieName == cookiePair[0].trim()) {
	                return decodeURIComponent(cookiePair[1]);
	            }
	        }
	        return null;
	    }
	    const scrollToView = (element) => {
	        element[0].scrollIntoView({
	            behavior: "smooth",
	            block: "center"
	        });
	    }

	    let
	        comment = getCookie("commentCookie"),
	        cookie_page_id = getCookie("pageId"),
	        reply = getCookie("replyCookie"),
	        comment_id = getCookie("commentIdCookie"),
	        page_id = $("#page_id").val();

	    if (comment != "" && comment != null && cookie_page_id == page_id) {
	        let comment_text = $("#comment");
	        comment_text.text(comment);

	        scrollToView(comment_text);
	    }

	    if ((reply != "" && comment_id != "") && (reply != null && comment_id != null)) {
	        let reply_text = $("#reply_textarea_" + comment_id);
	        let active_reply_form = $("#comment_reply_form_" + comment_id);

	        if (active_reply_form.length != 0) {
	            reply_text.text(reply);
	            active_reply_form.toggle(100);
	            $("#reply_btn_" + comment_id).text($("#reply_btn_" + comment_id).text() == "Reply" ? "Cancel" : "Reply");
	            scrollToView(active_reply_form);
	        }

	    }
	});