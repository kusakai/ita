var scrollAnimetion = function(a,b){
	
	this.sc = 0;
	this.wh = $(window).height();
	this.trigger = 0;
	
	this.init = function(a){
		this.obj = a;
		this.tg = $(a.target);
		this.fn()
	}
	
	this.fn = function(){
		var a = this
		
		$(window).scroll(function(){
			a.sc = $(window).scrollTop();
			a.interval()
		})
	};
	
	function setWindowHieght(){
		this.wh = $(window).height();
	}
	
	$(window).resize(function(){
		setWindowHieght();
	})
}

scrollAnimetion.prototype.interval = function(){

	switch (this.obj.base){
	  case "TOP":
		this.trigger = this.tg.offset().top;
		break;
	  case "BOTTOM":
		this.trigger = this.tg.offset().top - this.wh;
		break;
	  case "CENTER":
		this.trigger = this.tg.offset().top - this.wh/2;
		break;
	}

	if(this.sc > this.trigger + this.obj.correction && this.sc < this.trigger + this.obj.correction + this.obj.distance){
		this.obj.start();
	}else{
		this.obj.end();
	}
	//console.log(this.sc,this.trigger + this.obj.correction);
}

////////////////////////////


$(function(){
	
	var a = [];
	var b = [];
	var w = $(window).height();
	var hosei = 0
	
	if(_ua.Mobile){
		hosei = 500;
	}
	
	for(var i=0; i< $(".user-commnet .user").length; i++){
		var tg = $(".user-commnet .user")[i]
		var ab = new scrollAnimetion()
		
		ab.init(
		{
			target:tg ,base:"BOTTOM",correction:30, distance:w + hosei,
			start:function(){
				$(this.target).addClass("fukidasiAnime");
			},
			end:function(){
				$(this.target).removeClass("fukidasiAnime");
			}
		});
	}
	
})


$(window).load(function(){
	if(!_ua.Mobile){
	}
});

var enterFrame = function(a,b){
	this.obj = $(a);
	this.frs = 1000/b;
	this._width = $(a).width();
	this._height = $(a).height();
	this._top = $(a).offset().top;
	this._left = $(a).offset().left;
}

enterFrame.prototype.fn = {
	 onEnterFrame:function(fn){
		this.ID = setInterval(fn,this.frs);
	},

	clearFrame:function(){
		clearInterval(this.ID)
	},
	
	resize:function(){
		this._width = $(a).width();
		this._heiht = $(a).height();
		this._top = $(a).offset().top;
		this._left = $(a).offset().left;
	}
}


$(function(){
	
	var _ws = $(window).scrollTop();
	var _ww = $(window).width();
	var _wh = $(window).height();
	
	$(window).load(function(){
		
		var hum = new enterFrame(".human",200);
		var pos0 = $("#s0").offset().top;

		hum.fn.onEnterFrame(function(){
			//console.log("scroll"+ _ws + " - pos" + (pos1 - _wh));

			if(_ws < 10){
				removeClass();
			}
		});
	})
	
	function removeClass(){
	}
	
	$(window).scroll(function(){
		_ws = $(window).scrollTop();
	});
	
	$(window).resize(function(){
		_ww = $(window).width();
		_wh = $(window).height();
	});
})
