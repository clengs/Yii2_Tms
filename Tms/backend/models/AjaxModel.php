<?php

namespace backend\models;

use Yii;
use backend\models\AreaModel;


class AjaxModel
{
	private $findId = 1;	//要查询的ID
 	private $cityModel;		//查询到的model数据
 	private $cityArray = array();		//地市
 	private $channelArray = array();	//渠道
 	private $marketingArray = array();	//营销

 	private $adminModel;	//对应的adminmodel


 	//设置要获取数据的ID
 	public function setFindId($value){
 		$this->findId = $value;
 	}

 	//获取数据先调用此方法
 	public function processData(){
 		$areaModel = new AreaModel();
 		$this->cityModel = $areaModel->getCityList($this->findId);

 		foreach ($this->cityModel as $value) {
			$this->cityArray[$value['childId']] = array();
			$this->cityArray[$value['childId']] = ['id' => $value['childMenu']];

			$this->marketing = $areaModel->getCityList($value['childId']);	
			$this->marketingArray[$value['childId']] = array();	
			foreach ($this->marketing  as  $value2) {
				$this->marketingArray[$value['childId']][$value2['childId']] = ['id' => $value2['childMenu']];

				$this->channel = $areaModel->getCityList($value2['childId']);
				$this->channelArray[$value2['childId']] = array();
				foreach ($this->channel as $value3) {
					$this->channelArray[$value2['childId']][$value3['childId']] = ['id'=>$value3['childMenu']];
				}
			}
		}
 	}

 	public function getCityArray(){
 		if($this->cityArray == NULL){
 			return NULL;
 		}else{
 			return $this->cityArray;
 		}
 	}

 	public function getChannelArray($value){
 		return $this->channelArray[$value];
 	}

 	public function getMarketingArray($value){
 	  return $this->marketingArray[$value];
 	}

 	public function getCityModel(){
 		return $this->cityModel;
 	}

 	//获取adminModel
 	public function getAdminModel($value){
 		$this->adminModel = new AdminModel();
 		return $this->adminModel->getManagerModel($value);
 	}

 	//获取地址下面的用户
 	public function getManagerList($value){
 		$admin = $this->getAdminModel($value);
 		$adminList = array();
 		foreach ($admin as $_value) {
 			$adminList[$_value['id']] =  $_value['username'];
 		}

 		return $adminList;
 	}



	//获取营销中心的地址值json
	public function getMarketingJson($value){
		$market_arr = $this->getMarketingArray($value);
		$market_len = sizeof($market_arr);
		$market_json['message']=array();

		foreach ($market_arr as $key => $value) {
			array_push($market_json['message'], ['id' => $key, 'market_name'=> $value['id']]);
		}
		
		return $market_json;
	}

	//获取渠道中心的地址值json
	public function getChannelJson($value){
		$channel_arr = $this->getChannelArray($value);
		$channel_len = sizeof($channel_arr);
		$channel_json['message']=array();

		foreach ($channel_arr as $key => $value) {
			array_push($channel_json['message'], ['id' => $key, 'market_name'=> $value['id']]);
		}
		
		return $channel_json;
	}

	//获取对应地市的管理人员json
	public function getManagerJson($value){
		$managelist = $this->getManagerList($value);
		$manageJson['message'] = array();
		foreach ($managelist as  $key => $_value) {
			array_push($manageJson['message'], ['id'=> $key, 'name' => $_value]);
		}

		return $manageJson;
	}
}

