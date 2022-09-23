$("document").ready(function(){
	"use strict";
	$("#confirm-dialog").on("click",".btn-delete",function(e){
		$("#confirm-dialog").modal("hide");
	});
	$("#confirm-dialog").on("show.bs.modal", function(e){
		let anchor = $(e.relatedTarget).attr("href");
		$(".btn-delete",this).attr("href",anchor);
	});
	$("#confirm-dialog").on("hidden.bs.modal", function(e){
		let putHash = "#";
		$(".btn-delete").attr("href",putHash);
	});
});