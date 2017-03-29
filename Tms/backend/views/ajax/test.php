<?php  
header("Content-type:text/html;charset=utf-8");

use backend\models\AreaModel;

 $id = 1;//毕节市的ID
 $parentIndex = 0;
 $model = new AreaModel();
 $cityModel = $model->getCityList($id);
 $cityArray = array();
 $channelArray = array();
 $marketingArray = array();

foreach ($cityModel as $value) {
	$cityArray[$value['childId']] = array();
	echo $value['childMenu'].'<br/>';

	$channel = $model->getCityList($value['childId']);
	foreach ($channel as  $value2) {
		$cityArray[$value['childId']][$value2['childId']] = $value2['childMenu'];
		echo "&nbsp;&nbsp;------".$cityArray[$value['childId']][$value2['childId']].'<br/>';

		$marketing = $model->getCityList($value2['childId']);
		$channelArray[$value2['childId']] = array();
		foreach ($marketing as $value3) {
			$channelArray[$value2['childId']][$value3['childId']] = $value3['childMenu'];
			echo "&nbsp;&nbsp;&nbsp;&nbsp;------".$channelArray[$value2['childId']][$value3['childId']].'<br/>';
		}
	}
}
?>

<script type="text/javascript" src="/statics/js/jquery-3.1.1.min.js"></script>
<script language="javascript" type="text/javascript">

	var unid;

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
	
	function show(){
		document.getElementById("marketing").options.add(new Option("北京", 1));
	}

	function modal_saveChange(){
		var channel_text = $("#channel").find("option:selected").text();
		var channel_val = $("#channel").find("option:selected").val();

		modal_clean();	
		document.getElementById("testDIv").innerHTML = channel_text+":"+channel_val;
		$(window.unid).val("yes");
	}

	function modal_clean(){
		$("#channel").empty();
		$("#marketing").empty();
		$("#area").val("select");
	}

	function setId(id){
		window.unid = ("#" +id);
	}
</script>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" onclick="setId('gole')" >
	Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">區域選擇</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="col-sm-4">
						<select class="form-control" name="area" id="area" onchange="areaChange()">
							<option value="select">--請選擇--</option>
							<?php foreach ($cityModel as $value):?>
								<option value=<?php echo $value['childId']?>><?php echo $value['childMenu'];?></option>>
							<?php endforeach;?>
							
						</select>
					</div>
					<div class="col-sm-4">
						<select class="form-control" name="marketing" id="marketing" onchange="marketChange()">
						</select>
					</div>
					<div class="col-sm-4">
						<select class="form-control" name="channel" id="channel">
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="modal_saveChange()">Save changes</button>
			</div>
		</div>
	</div>
</div>

<input type="text" name="" id="gole">
<div id="testDIv">
	
</div>
<input type="button" class="btn btn-default" onclick="" value="展示">


