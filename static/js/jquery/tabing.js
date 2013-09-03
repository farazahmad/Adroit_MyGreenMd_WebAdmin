$(document).ready(function(){
		$(".tm-cont li").live("click",function(){
			$(".tm-cont li").removeClass("tm-active");
      $(this).addClass("tm-active");
			$(".container div.content,.container div.content_active").addClass("content");
			$(".container div.content,.container div.content_active").removeClass("content_active");
			var nocontent = $(".tm-cont li").index(this);
			$(".container div.content,.container div.content_active").removeClass("content_active").addClass("content");
			$(".container div.content:eq("+nocontent+"),.container div.content_active:eq("+nocontent+")").removeClass("content").addClass("content_active");
		});
	});