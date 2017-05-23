

var gmapAdd = function(){

	this.init = function(a,b){

		var map;
		var data;
		var maxLatLng;
		var minLatLng;
		var bounds;
		var markAry = [];
		var infoWindAry = [];
		var addressNum;
		var infowindow;
		
		var directionDisplay;
		var directionsService = new google.maps.DirectionsService();
		
		var icoObj = {
			"ico1":{"name":"original","path":"images/pin.png","width":186,"height":157},
			"ico_ghv":{"name":"original","path":"../images/pin_02.png","width":174,"height":132},
			"ico_whg":{"name":"original","path":"../images/pin_03.png","width":174,"height":132},
			"ico_frs":{"name":"original","path":"../images/pin_04.png","width":174,"height":132},
			"ico_ghh":{"name":"original","path":"../images/pin_05.png","width":174,"height":132},
			}
		
		$.ajax({
			url:a,
			dataType:"xml",
			success:function(xml){
				data = parseXml(xml);
				initialize();
			}
		})
		
		
		function parseXml(xml){
			
			var ary = [];
			$("marker",xml).each(
				
				function(){
					var obj = new Object();
					obj.lat = Number($("lat",this).text());
					obj.lng = Number($("lng",this).text());
					obj.name = $("name",this).text();
					obj.content = $("data",this).text();
					obj.icon = $("icon",this).text();
					ary.push(obj);
			});
			return ary
		}
		
		
		function initialize() {
			
			/*---------------------ここから-----------------*/
			var styles = [
  {
    "stylers": [
      { "saturation": -77 },
      { "hue": "#ff8000" },
      { "gamma": 0.7 },
      { "lightness": -20 }
    ]
  }
]
			
			var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});
			/*---------------------ここまで追加-----------------*/
			
			
			directionsDisplay = new google.maps.DirectionsRenderer();
			
			var myOptions = {
				zoom: 17,
				scrollwheel: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			
			
			map = new google.maps.Map(document.getElementById(b),myOptions);
			directionsDisplay.setMap(map);
			
			bounds = getBounds();
			//map.fitBounds(bounds);
			//map.setCenter(new google.maps.LatLng(40.296559346681626, 140.82446202778624));
			map.setCenter(bounds.getCenter());
			setMarkers(map);
			addressSet();
			officeClick();
			
			/*---------------------ここから-----------------*/
			map.mapTypes.set('map_style', styledMap);
			map.setMapTypeId('map_style');
			/*---------------------ここまで追加-----------------*/
		}
		
		function officeClick(){
		}
		
		function linkClick(a,b){
			map.panTo(markAry[a].marker.position2)
			infowOpen(data[a].marker,a);
			map.setZoom(b);
		}
		
		function calcRoute() {
		
			var radio = document.getElementsByName("trabel");
			var start = markAry[addressNum].marker.position;
			var end = document.getElementById("end").value;
			
			var request = {
				origin:start, 
				destination:end,
				travelMode: google.maps.DirectionsTravelMode.DRIVING
			};
			
			directionsService.route(request, function(result, status) {
				if (status == google.maps.DirectionsStatus.OK) {
					alert(google.maps.DirectionsStatus.OK)
				  directionsDisplay.setDirections(result);
				}
			});
		}
		
		
		function setMarkers(map) {
			
			for (var i = 0; i < data.length; i++) {
				
				var obj = new Object();
				var myLatLng = new google.maps.LatLng(data[i].lat, data[i].lng);
				var myLatLng2 = new google.maps.LatLng(data[i].lat, data[i].lng -0.02);
				var mr = {
						position: myLatLng,
						position2: myLatLng2,
						map: map,
						title: "",
						zIndex: i
					}
				
				if(data[i].icon != "default"){
					
					var path = icoObj[data[i].icon].path;
					var width = icoObj[data[i].icon].width;
					var height = icoObj[data[i].icon].height;
					var image = new google.maps.MarkerImage();
					
					var image = new google.maps.MarkerImage(							
						path,
						new google.maps.Size(width, height),
						new google.maps.Point(0,0),
						new google.maps.Point(width/4, height/2)
					);
					image.scaledSize = new google.maps.Size(width/2, height/2)
					
					mr.icon = image	
				}
				
				var marker = new google.maps.Marker(mr);
				
				obj.marker = marker;
				markAry.push(obj)
				attachSecretMessage(marker,i)
			} 
		}
		
		
		function attachSecretMessage(marker,num) {
			
			addressNum = num
			google.maps.event.addListener(marker, 'click', function() {
				infowOpen(marker,num);
				opSet(num)
			});
		}
		
		infowindow = new google.maps.InfoWindow();
		function infowOpen(marker,num){
			
			var infoWind = {
				content: data[num].content,
				size: new google.maps.Size(200,200),
				pixelOffset:new google.maps.Size(-18,0),
				maxWidth:400
			}
			
			infowindow.setOptions(infoWind)
			infowindow.open(map, markAry[num].marker);
			//map.panTo( markAry[num].marker.position)
		}


		function addressSet(){
		
			for(var i=0; i<data.length; i++){	
				var co = data[i].name
				var obj = $("#addressList .defult").after('<option value=' + i + '>'+ co + '</option>');
		}
		
		$("#addressList").change(function(){
			addressNum = Number($("#addressList option:selected").val());
			infowOpen(markAry[addressNum].marker,addressNum)
			})
		}
		
	
		
		function opSet(a){
			var op = $("#addressList option")
		
			for(var i=0; i<op.length; i++){
				
				if($(op[i]).val() == a){
					$("#addressList").val(a)
					return false;
				}
			}
		}
		
		
		function getBounds(){
		
			var maxLat;
			var minLat;
			var maxLng;
			var minLng;
			
			for(var i=0; i<data.length; i++){
				
				if(i == 0){
					maxLat = minLat = data[i].lat
					maxLng = minLng = data[i].lng
				}else{
					
					if(maxLat < data[i].lat){
						maxLat =  data[i].lat
					}else if(minLat > data[i].lat){
						minLat =  data[i].lat
					}
					
					if(maxLng < data[i].lng){
						maxLng =  data[i].lng
					}else if(minLng > data[i].lng){
						minLng =  data[i].lng
					}
				}
			}
			
			var gb = new google.maps.LatLngBounds(new google.maps.LatLng(minLat, minLng),new google.maps.LatLng(maxLat, maxLng))
			return gb
		
		}
	}
}