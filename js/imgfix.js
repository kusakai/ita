$(function(){
	
	var boxAry = [];
	var num = -1;
	var ww = 0;
	
	init()
	
	function init(){
		imgSet();
	}
	
	function imgSet(){
		
		for(var i=0; i<$(".bii").length; i++){
			var b = $($(".bii")[i]).find("img");
			b.w = b.width();
			b.h = b.height();
			boxAry.push(b)
		}
		imgResize()
	}
	
	function imgResize(){
		for(var i=0; i<boxAry.length; i++){
			var ob = boxAry[i]
			ob.obj = getCenter(ob);
			$(ob).css("width",ob.obj.w).css("height",ob.obj.h).css("top",-ob.obj.cy).css("left",-ob.obj.cx);
		}
	}
	
	
	function getCenter(a){
		
		w = a.w;
		h = a.h;
		ww = $(window).width()
		
		var obj = new Object();
		if(ww < w){
			obj.w = w
			obj.h = h
			obj.cx = w / 2;
			obj.cy = h / 2;
		}else{
			obj.w = ww;
			obj.h = Math.floor(ww*h/w);
			obj.cx = Math.floor(ww/2);
			obj.cy = Math.floor(obj.h/2);
		}
		return obj;
	}
	
	
	
	$(window).load(function(){
		//init();
	})
	$(window).resize(function(){
		imgResize()
	})
	
})
