



$(function(){
	
	var $window = $(window);
	var $menuButton = $(".menu-btn");
	var $wrapper = $("cwl-main");
	var $nav = $(".cwl-left");
    //ナビゲーションの高さ
	
	TweenMax.set($("header"), {perspective:800});
	TweenMax.set($(".logo"),{"transformOrigin":"0% 0% 0%",});
	TweenMax.set($(".search-sns"),{"transformOrigin":"0% 0% 0%",});
	TweenMax.set($("nav ul li"),{"transformOrigin":"0% 0% 0%",});
	
	
    navHeight = $nav.height(),
 
    //アニメーションの速度
    SPEED = 300,
 
    //wrapperの高さを取得
    bodyHeight = $window.height(),
 
    //ヘッダータイトルの高さ
    HEADER_HEIGHT = 65;
	$menuButton.on('click',function(){
		
        //open用のクラスがあるかどうか判定
        if($menuButton.hasClass('open')){
            //閉じるときの動き
			
            closeAction();
        } else {
            //開くときの動き
            openAction();
        }
    });
	
	
	function openAction(){
		//クラスをつける
	 	$menuButton.addClass("open")
		
		 TweenMax.to($(".logo"), 0.6, { "transform": "rotateY(90deg)", repeat: 0, ease: Power3.easeInOut,force3D:true });
		
		 TweenMax.to($(".search-sns"), 1, { "transform": "rotateY(90deg)", repeat: 0, ease: Power3.easeInOut,force3D:true });
		
		 TweenMax.staggerTo($("nav ul li"), 0.5, { "transform": "rotateY(90deg)", repeat: 0, ease: Power3.easeInOut,force3D:true },0.1);
		
		
		TweenMax.to($(".cwl-main"), 1, { 
			"padding-left": "0",
			repeat: 0,
			ease: Power3.easeInOut
		},1);
		
		
	}
	
	function closeAction(){
		
		 TweenMax.to($(".logo"), 1, { "transform": "rotateY(0deg)", repeat: 0, ease: Power3.easeInOut,force3D:true });
		
		 TweenMax.to($(".search-sns"), 1, { "transform": "rotateY(0deg)", repeat: 0, ease: Power3.easeInOut,force3D:true });
		
		 TweenMax.staggerTo($("nav ul li"), 0.3, { "transform": "rotateY(0deg)", repeat: 0, ease: Power3.easeInOut,force3D:true },0.1);
		
		TweenMax.to($(".cwl-main"), 1, { 
			"padding-left": "250",
			repeat: 0,
			ease: Power3.easeInOut
		
		});
		
		$menuButton.removeClass("open");
		
	}
	
})