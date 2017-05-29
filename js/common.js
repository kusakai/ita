
TweenMax.set($(".article-list .box"), {perspective:800});
TweenMax.set($(".article-list figure .front"), {"backface-visibility":"hidden","transform": "translateZ(-1px),rotateY(0deg)","transform-origin":"50% 50%",force3D:true});
TweenMax.set($(".article-list figure .back"), {"backface-visibility":"hidden","transform": "rotateY(180deg)","transform-origin":"50% 50%",force3D:true});
TweenMax.set($(".article-list figure"), {"transformOrigin":"50% 50% 0%", "transformStyle":"preserve-3d"});
$(function(){
	
	
$(".article-list a").hover(
  function() {
	  TweenMax.to($(this).find("figure"), 1, { "transform": "rotateY(180deg)", repeat: 0, ease: Power3.easeInOut,force3D:true });
  }, function() {
	  TweenMax.to($(this).find("figure"), 1, { "transform": "rotateY(0deg)", repeat: 0, ease: Power3.easeInOut,force3D:true });
  }
);
	
	
	
	
TweenMax.to("#quote" , 1 , {
  top : "0px" , // CSSのプロパティ(+=とかも使えます)
  delay : 0.5 , // 実行までの待ち時間です
　ease : "Linear" , // イージングです。後述しますがTweenMax独自のイージングもあります。
  onComplete : function(){} , // 処理完了後に呼ばれる関数を指定できます。
  onStart  : function() {} , // 処理開始前に呼ばれる関数を指定できます。
  onUpdate : function() {} // 処理実行中に呼ばれる関数を指定できます。動作しつつ
});
	
	//TweenMax.to($("#quote"), 1, {"transform": "rotateY(180deg)",yoyo:true, repeat:0});
	
})

$(function(){
	$(window).on('load', function() {
        console.log('load');
    });
})


$(function(){
	for(var i=0; i<$(".bg").length; i++){
		var bg = $($(".bg")[i]).attr("data-bg");
		var bgUrl = 'url('+bg+')';
		$($(".bg")[i]).css('background-image',bgUrl);
	}
	
})

var _ua = (function(u){
	
  return {
    Tablet:(u.indexOf("windows") != -1 && u.indexOf("touch") != -1 && u.indexOf("tablet pc") == -1) 
      || u.indexOf("ipad") != -1
      || (u.indexOf("android") != -1 && u.indexOf("mobile") == -1)
      || (u.indexOf("firefox") != -1 && u.indexOf("tablet") != -1)
      || u.indexOf("kindle") != -1
      || u.indexOf("silk") != -1
      || u.indexOf("playbook") != -1,
    Mobile:(u.indexOf("windows") != -1 && u.indexOf("phone") != -1)
      || u.indexOf("iphone") != -1
      || u.indexOf("ipod") != -1
      || (u.indexOf("android") != -1 && u.indexOf("mobile") != -1)
      || (u.indexOf("firefox") != -1 && u.indexOf("mobile") != -1)
      || u.indexOf("blackberry") != -1
  }
})(window.navigator.userAgent.toLowerCase());


var _br = (function(a,b){
	
	if (a.indexOf('msie') != -1) {
		  /* IE. */
		  if (b.indexOf("msie 6.") != -1) {
			return 'ie6';
		  } else if (b.indexOf("msie 7.") != -1) {
			return 'ie7';
		  } else if (b.indexOf("msie 8.") != -1) {
			return 'ie8';
		  } else if (b.indexOf("msie 9.") != -1) {
			return 'ie9';
		  } else if (b.indexOf("msie 10.") != -1) {
			return 'ie10';
		  } else {
			return 'ie';
		  }
		} else if (a.indexOf('chrome') != -1) {
		  return 'chrome';
		} else if (a.indexOf('firefox') != -1) {
		  return 'firefox';
		} else if (a.indexOf('safari') != -1) {
		  return 'safari';
		} else if (a.indexOf('opera') != -1) {
		  return 'opera';
		} else if (a.indexOf('gecko') != -1) {
		  return 'gecko';
		} else {
		  return false;
		}
})(window.navigator.userAgent.toLowerCase(),window.navigator.appVersion.toLowerCase())




$(function(){
	
	var ID;
	var py;
	var flag = false;
	
	$(window).scroll(function(){
		py = $(window).scrollTop();	
		
		if(py > 300){
			
			if(!flag){
			
			headerMove(1)
			flag = !flag
			}
			
		}
		else{
			if(flag){
			headerMove(0)
			flag = !flag
			}
			
		}
		
		 		
	})
	
	function headerMove(a){
		$(".header").stop().animate({top:-150},{duration: 400, easing: "easeOutCubic",
			complete:function(){
				if(a == 1){
					$(".header").addClass("head2");
					$(".header .logo img").attr("src","http://www.h-kazuno.co.jp/images/header_logo_b.png").width(150);
				}else{
					$(".header").removeClass("head2");
					$(".header .logo img").attr("src","http://www.h-kazuno.co.jp/images/header_logo_w.png").width(150);
				}
				$(".header").stop().animate({top:0},{duration: 400, easing: "easeOutCubic"});
			}});
	}
		
	//$(window).unbind('scroll')
})


function getRequest(){
  if(location.search.length > 1) {
    var get = new Object();
    var ret = location.search.substr(1).split("&");
    for(var i = 0; i < ret.length; i++) {
      var r = ret[i].split("=");
      get[r[0]] = r[1];
    }
    return get;
  } else {
    return false;
  }
}





$(function(){
	
	var pageScroll = function(a,b) {
	
		allAnk = $('a[href^=#], area[href^=#]').not('a[href=#], area[href=#]');
		linkAry =[];
		
		this.init = function(){
			for(var i=0; i< allAnk.length; i++){
				var txtAry = allAnk[i].href.split("#")
				allAnk[i].txt = txtAry[txtAry.length-1];
				$(allAnk[i]).click(function(e){clickHandler(this.txt);return false;})
			}
		}
		
		function clickHandler(txt){
			var id = "#"+txt
			if($(id)[0] != undefined){
				var offset = $(id).offset()
				$('html,body').stop().animate(
					{scrollTop:offset.top},
					{duration: a, easing: b}
					);
			}else{
				return false;
			}			
		}
	}
	
	$(window).on(function(){
		var ps = new pageScroll(1500,"easeOutCubic");
		ps.init();
	})
})


/*
var altCheck = function(){

init();

	function init(){
		
		for(var i=0; i< $("img").length; i++){
			var id = "b" + i;
			var offset = $($("img")[i]).offset();
			
			var alt = $($("img")[i]).attr("alt");
			var box = '<div id="'+ id +'">'+ alt +'</div>'
			$("html").prepend(box);
			$("#b"+i).css(setCss(offset.left, offset.top))
		}
		
	}
	
	function setCss(x,y){
		
		var cssObj = {
			top:y,
			left:x,
			padding:"3px",
			border:"1px solid #CCCCCC",
			position:"absolute",
			background:"#F2E936",
			fontSize:"10px",
			zIndex:9999
		}
		return cssObj
	}
	
}
*/