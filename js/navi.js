$(function(){
	
	var $window = $(window),
    $wrapper = $('#wrapper'),
    $accordion = $('.navi'),
    $menuButton = $(".menu-button"),
    $jsCover = $('#js-cover'),
    $nav = $('.nav-content'),
 
    //ナビゲーションの高さ
    navHeight = $nav.height(),
 
    //アニメーションの速度
    SPEED = 300,
 
    //wrapperの高さを取得
    bodyHeight = $wrapper.height(),
 
    //ヘッダータイトルの高さ
    HEADER_HEIGHT = 65;
	$menuButton.on('click',function(){
		
		
        //open用のクラスがあるかどうか判定
        if($accordion.hasClass('is-open')){
            //閉じるときの動き
			
            closeAction();
        } else {
            //開くときの動き
            openAction();
        }
    });
	
	
	function openAction(){
		//クラスをつける
		$accordion.addClass('is-open');
	 	$menuButton.addClass("open")
		//wrapperの高さwindowの高さと同じにする
		//$wrapper.css({overflow:'hidden'}).height(windowHeight);
	 
		//高さをつけてオーバーレイを表示
		//$jsCover.height(windowHeight).stop().animate({opacity:1},SPEED);
	}
	
	function closeAction(){
		//クラスを外す
		$menuButton.removeClass("open")
		$accordion.removeClass('is-open');
	 	
		//wrapperの高さを元にもどしてスクロールできるようにする。
		$wrapper.css({overflow:'visivle'}).height(bodyHeight);
	 
		//オーバーレイが消える
		$jsCover.stop().animate({opacity:0},SPEED);
	}
	
})