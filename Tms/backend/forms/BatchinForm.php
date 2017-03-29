<?php 
namespace backend\forms;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * 终端批量上传的model
 * 需要在PHP.ini 放开php_fileinfo.dll
 */
 class BatchinForm extends Model
 {
 	public $manager;	//操作员
    public $inboundTime;//入库时间
    public $manufacturer;//厂家
    public $storeId;//库房ID
    public $excelfile;//文件

    public function rules()
    {
    	return [
    		[['manager','inboundTime', 'manufacturer', 'storeId'], 'required'],
    		[['excelfile'], 'file', 'extensions' => 'xls, xlsx, bmp, jpg'],		
    	];
    }

    public function upload()
    {
        if($this->validate()){
            //正确写法
            //$this->excelfile->saveAs(dirname(__DIR__)."/file/upload/temp/" . $this->excelfile->baseName . '.' . $this->excelfile->extension);
            //测试写法
            $this->excelfile->saveAs(dirname(__DIR__)."/file/upload/temp/" . date("YmdHi")."-terminal." . $this->excelfile->extension);
            return true;

        }else{
            return false;
        }
    }
 } 