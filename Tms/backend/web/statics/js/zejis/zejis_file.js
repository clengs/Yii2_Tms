function areaChange(){
	var xmlHttp;
	if(window.XMLHttpRequest){
		xmlHttp = new XMLHttpRequest();
	}else{
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		alert("nnn");
	}

	var areaId = $("#area").find("option:selected").val();
	var areaName = $("#area").find("option:selected").text();

	//清空第二项的值以及后面的值
	$("#marketing").empty();
	$("#channel").empty();

	xmlHttp.open("GET", "area?areaId="+areaId + "&areaName=" + areaName,true);

	xmlHttp.send();

	xmlHttp.onreadystatechange = function(){
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			var json_data = xmlHttp.responseText;
			var obj = $.parseJSON(json_data);
			for(var i=0; i<obj.message.length; i++){
				$("#marketing").append("<option value="+obj.message[i].id +">"+ obj.message[i].market_name+"</option>")
			}
		}else{
		}
	}
}

function marketChange(){
	var xmlHttp;
	if(window.XMLHttpRequest){
		xmlHttp = new XMLHttpRequest();
	}else{
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		alert("nnn");
	}

	var areaId = $("#marketing").find("option:selected").val();
	var areaName = $("#marketing").find("option:selected").text();

	//清空第二项的值以及后面的值
	$("#channel").empty();
	
	xmlHttp.open("GET", "channel?areaId="+areaId + "&areaName=" + areaName,true);

	xmlHttp.send();

	xmlHttp.onreadystatechange = function(){
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			var json_data = xmlHttp.responseText;
			var obj = $.parseJSON(json_data);
			for(var i=0; i<obj.message.length; i++){
				$("#channel").append("<option value="+obj.message[i].id +">"+ obj.message[i].market_name+"</option>")
			}
		}else{
		}
	}
}

function channelChange(){
}