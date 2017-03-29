<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\grid\CheckboxColumn;
use yii\datetimepicker\src\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\OutboundModel */
/* @var $form yii\widgets\ActiveForm */
//引入模态窗口
include(dirname(__DIR__)."/area/areamodal.php");

$this->title = Yii::t('common', 'outboundModel');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="outbound-model-form">
  
  <!-- 终端选择 -->
  <div class="row">
        <div class="col-md-12">
               <!-- 出库数据表单 -->
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-6">
                     <?= $form->field($outboundModel, 'adminId')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->username,'readonly'=>true]) ?>

                </div>
                <div class="col-md-6">
                    <?= $form->field($outboundModel, 'outboundTime')->widget(DateTimePicker::className(), [
                                            'language' => 'zh-CN',
                                            'size' => 'ms',
                                            'inline' => false,
                                            'clientOptions' => [
                                                'startView' => 1,
                                                'minView' => 0,
                                                'maxView' => 1,
                                                'autoclose' => true,
                                                'linkFormat' => 'yyyy-mm-dd 
                                                 hh:ii:ss', 
                                                'todayBtn' => true
                                            ]]);?>
                </div>
            </div>
             <div class="row">
                <div class="col-md-6">
                    <?= $form->field($outboundModel, 'outboundQuantity')->textInput() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($outboundModel, 'destinationId', ['inputTemplate' => 
                                        '<div class="input-group">
                                            {input}
                                            <span type="button" data-toggle="modal" data-target="#areaModal" class="input-group-addon" id="storechoosebtn" onclick="setId(\'outboundmodel-destinationid\',\'outboundmodel-receiverid\')">
                                                <span class="glyphicon glyphicon-th-large" aria-hidden="true">
                                                </span>
                                            </span>
                                        </div>',])->dropDownList(['' => ''], ['readonly' => 'true'])?>
                </div>
            </div>
             <div class="row">
                <div class="col-md-6">
                    <?= $form->field($outboundModel, 'receiverId')->dropDownList(['' => ''], ['readonly' => 'true'])?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($outboundModel, 'storehouseId')->textInput() ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
            <!-- 水平分割线 -->
            <hr style="border:1px dashed #7B7B7B" width="100%" size="1" />

            <?php echo $this->render('_terminalSearch', ['model' => $terminalSearch]); ?>
            <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'showFooter' => true,
                    'options' => [
                        'id' => 'grid',
                    ],
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn'],
                            'serialId',
                            'storeId',
                            'quantity',
                        [
                            'class' => 'yii\grid\CheckboxColumn',
                            'footerOptions'=>['colspan'=>4],
                            'footer'=> Html::a("确定", "javascript:postData();", ["class" => "btn btn-primary btn-xs gridview"]),
                        ],
                    ],

                    'pager'=>[
                        'firstPageLabel' => '第一页',
                        'lastPageLabel' => '最后一页',
                    ],
                ]); 
            ?>
            
        </div>
    </div> 

</div>

<script type="text/javascript">
    var terminalArr = new Array();

    $(function(){
    });

    function postData(){
        var adminId = $("#outboundmodel-adminid").val();
        var outboundTime = $("#outboundmodel-outboundtime").val();
        var outboundQuantity = $("#outboundmodel-outboundquantity").val();
        var destinationId = $("#outboundmodel-destinationid").val();
        var receiverId = $("#outboundmodel-receiverid").val();
        var storehouseId = $("#outboundmodel-storehouseid").val();

        var keys = $("#grid").yiiGridView("getSelectedRows");

        //获取_csrf,用于服务端验证
        var _csrf = $('meta[name="csrf-token"]').attr("content");

        //临时信息
        var tmp= {
                    "_csrf-backend":_csrf,
                    "info":
                    {
                        "adminId":adminId,
                        "outboundTime":outboundTime,
                        "outboundQuantity":outboundQuantity,
                        "destinationId":destinationId,
                        "receiverId":receiverId,
                        "storehouseId":storehouseId,
                    },
                    "terminal":keys
                };

        //将字符串转为json对象
        var jsonObj = JSON.stringify(tmp);
        console.log(jsonObj);
        $.ajax({
                type:"post",
                url:"terminaljson",
                data:jsonObj,
                dataType:"json",
                success: function(data) {
                    alert(data);
                    location.replace(location.href);
                    
                },
                error:function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest.status);
                    console.log(XMLHttpRequest.readyState);
                    console.log(textStatus);
                }
            });
    }
</script>
