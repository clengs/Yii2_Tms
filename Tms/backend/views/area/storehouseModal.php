<!-- 共用的模态框代码 -->
<?php  
	use backend\models\AjaxModel;

	$ajaxModel = new AjaxModel();
	$ajaxModel->processData();
	$cityModel = $ajaxModel->getCityModel();
?>

<!-- 弹出的区域选择窗口窗口 -->
<div class="modal fade" id="storehouseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">區域選擇</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="col-sm-3">
						<select class="form-control" name="area" id="area" onchange="areaChange()">
							<option value="select">--請選擇--</option>
							<?php foreach ($cityModel as $value):?>
								<option value=<?php echo $value['childId']?>><?php echo $value['childMenu'];?></option>>
							<?php endforeach;?>
						</select>
					</div>
					<div class="col-sm-3">
						<select class="form-control" name="marketing" id="marketing" onchange="marketChange()">
						</select>
					</div>
					<div class="col-sm-3">
						<select class="form-control" name="channel" id="channel">
						</select>
					</div>
					<div class="col-sm-3">
						<select class="form-control" name="storehouse" id="storehouse">
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

<script type="text/javascript">
	//唯一识别ID
	var unid;
	var managerid;

	//设置unid,params可随意设置
	function setId(id, params=null){
		window.unid = "#" + id;

		if(params != "" && typeof(params) != "undefined" && params != null){
			window.managerid = "#"+params;
		}
	}

	//地市改变
	function areaChange(){
		var xmlHttp;
		if(window.XMLHttpRequest){
			xmlHttp = new XMLHttpRequest();
		}else{
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		var areaId = $("#area").find("option:selected").val();
		var areaName = $("#area").find("option:selected").text();

		//清空第二项的值以及后面的值
		$("#marketing").empty();
		$("#channel").empty();

		xmlHttp.open("GET", "../area/areajson?areaId="+areaId + "&areaName=" + areaName,true);

		xmlHttp.send();

		xmlHttp.onreadystatechange = function(){
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
				var json_data = xmlHttp.responseText;
				var obj = $.parseJSON(json_data);
				$("#marketing").append("<option value="+"" +">"+ "--请选择--"+"</option>")
				for(var i=0; i<obj.message.length; i++){
					$("#marketing").append("<option value="+obj.message[i].id +">"+ obj.message[i].market_name+"</option>")
				}
			}else{
			}
		}

		getStorehouseJson(areaId);
	}

	//营销改变
	function marketChange(){
		var xmlHttp;
		if(window.XMLHttpRequest){
			xmlHttp = new XMLHttpRequest();
		}else{
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		var areaId = $("#marketing").find("option:selected").val();
		var areaName = $("#marketing").find("option:selected").text();

		//清空第二项的值以及后面的值
		$("#channel").empty();
		
		xmlHttp.open("GET", "../area/channeljson?areaId="+areaId + "&areaName=" + areaName,true);

		xmlHttp.send();

		xmlHttp.onreadystatechange = function(){
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
				var json_data = xmlHttp.responseText;
				var obj = $.parseJSON(json_data);
				$("#channel").append("<option value="+"" +">"+ "--请选择--"+"</option>")
				for(var i=0; i<obj.message.length; i++){
					$("#channel").append("<option value="+obj.message[i].id +">"+ obj.message[i].market_name+"</option>")
				}
			}else{
			}
		}

		getStorehouseJson(areaId);
	}

	//弹出模态框后保存的内容
	function modal_saveChange(){
		var zone = $("#storehouse").find("option:selected").text();

		//判断相应渠道是否有值,依次推出
		var zoneIndex = $("#storehouse").find("option:selected").val();

		$(window.unid +" option:selected").html(zone);
		$(window.unid +" option:selected").val(zoneIndex);

		getStorehouseJson('#storehouse')
		modal_clean();
	}

	//清空
	function modal_clean(){
		$("#channel").empty();
		$("#marketing").empty();
		$("#storehouse").empty();
		$("#area").val("select");
	}

	//获取仓库的信息
	function getStorehouseJson(areaId){
		$("#storehouse").empty();
		var xmlHttp;
		if(window.XMLHttpRequest){
			xmlHttp = new XMLHttpRequest();
		}else{
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlHttp.open("GET", "../storehouse/storehousejson?areaId="+areaId ,true);

		xmlHttp.send();

		xmlHttp.onreadystatechange = function(){
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
				var json_data = xmlHttp.responseText;
				var obj = $.parseJSON(json_data);
				for(var i=0; i<obj.message.length; i++){
					$("#storehouse").append("<option value="+obj.message[i].id +">"+ obj.message[i].name+"</option>");
				}
			}else{
			}
		}
	}
</script>