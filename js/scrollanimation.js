

$(window).load(function(){
var sa = new scrollAnime($(".sac"),"animeAction",100);
var sa2 = new scrollAnime($(".dress-list2 a"),"animeAction2",100);
var sa3 = new scrollAnime($("#instafeed li"),"animeAction2",100);
var sa4 = new scrollAnime($(".bland li"),"animeAction2",100);

})

var scrollAnime = function(a,b,c){
	
	init();
	
	function init(){
		
		a.css("opacity",0);
		
		$(window).scroll(function (){
			 a.each(function(){
				 var pos = $(this).offset().top;
				 var scroll = $(window).scrollTop();
				 var windowHeight = $(window).height();
				 if (scroll > pos - windowHeight + Number(c)){
					  $(this).css("opacity",1)
					 $(this).addClass(b)
				 };
				 
			})
		})
	}

}

