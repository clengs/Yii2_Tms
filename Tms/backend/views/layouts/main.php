<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use backend\widgets\sidebar\SidebarWidget;
use backend\models\AuditingModel;
use backend\models\ApplicationModel;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<!-- script -->

<!-- 引入需要的文件 -->
<link rel="stylesheet" type="text/css" href="/statics/css/fileinput/fileinput.css" media="all">
<script type="text/javascript" src="/statics/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/statics/js/fileinput/fileinput.js"></script>
<script type="text/javascript" src="/statics/js/fileinput/fileinput_locale_zh.js"></script>

<script type="text/javascript">
    $(function(){
        //当前时间
        document.getElementById("time").innerHTML = new Date().toLocaleString();
        setInterval("document.getElementById('time').innerHTML = new Date().toLocaleString();",1000);

        var time1 = new Date().Format("yyyy-MM-dd");
        document.getElementById('msgtime').innerHTML = time1;
    });

    //日期的格式化方式
    Date.prototype.Format = function (fmt) {
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "h+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
    }

</script>

<?php $this->beginBody() ?>
<header>
    <div class="headerpanel">
        <div class="logopanel">
            <h2><a href="#">终端管理系统</a></h2>
        </div><!-- logopanel -->
        
        <div class="headerbar">
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

            <!-- 查询模块 -->
            <div class="searchpanel">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                    </span>
                </div><!-- input-group -->
            </div>

        
            <div class="header-right">
                <ul class="headermenu">
                    <li>
                    <div id="noticePanel" class="btn-group">
                        <button class="btn btn-notice alert-notice" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-commenting"></i>
                        </button>
                        <div id="noticeDropdown" class="dropdown-menu dm-notice pull-right">
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li class="active"><a data-target="#notification" data-toggle="tab">消息</a></li>
                                <li><a data-target="#reminders" data-toggle="tab">提醒</a></li>
                            </ul>
    
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="notification">
                                    <ul class="list-group notice-list">
                                        <li class="list-group-item unread">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                                <div class="col-xs-10">
                                                    <h5><a href="#">消息</a></h5>
                                                    <small id="msgtime"></small>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <?= Html::a('处理中...('.count(AuditingModel::find()->where(['aprover'=>Yii::$app->user->identity->id, 'remain_str'=> '0'])->all()).")",  
                                                ['auditing/dealmessage','id'=>Yii::$app->user->identity->id],
                                                ['class' => 'btn-more'])
                                    ?>
                                    <?= Html::a('新消息('.count(ApplicationModel::find()->where(['aprover'=>Yii::$app->user->identity->id])->all()).")", 
                                                ['auditing/newmessage', 'id'=>Yii::$app->user->identity->id],
                                                ['class' => 'btn-more'])
                                    ?>
                                </div><!-- tab-pane -->
    
                                <div role="tabpanel" class="tab-pane" id="reminders">
                                    <h1 id="todayDay" class="today-day"></h1>
                                    <h3 id="todayDate" class="today-date"></h3>
                                    <h4 class="panel-title">即将到期</h4>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-xs-2">
                                                    <h4>20</h4>
                                                    <p>Aug</p>
                                                </div>
                                                <div class="col-xs-10">
                                                    <h5><a href="">HTML5/CSS3 Live! United States</a></h5>
                                                    <small>San Francisco, CA</small>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <a class="btn-more" href="">查看更多提醒 <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </li>
                    
                    <li>
                        <div class="btn-group">
                            <button type="button" class="btn btn-logged" data-toggle="dropdown">
                                <img src="<?=Yii::$app->user->identity->avatar ?>" alt="头像">
                                <?=Yii::$app->user->identity->username?>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li><?= Html::a('&nbsp;&nbsp;个人中心', ['admin/update', 'id' => Yii::$app->user->identity->id,], ['class' => 'fa fa-user']) ?></li>
                                <li><?= Html::a('&nbsp;&nbsp;设置', ['admin/create'], ['class' => 'fa fa-cog']) ?></li>
                                <li><?= Html::a('&nbsp;&nbsp;退出', ['site/logout'], ['class' => 'fa fa-sign-out', 'data-method' => 'post']) ?></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div><!-- header-right -->
        </div><!-- headerbar -->
    </div><!-- header-->
</header>

<section>

<div class="leftpanel">
    <div class="leftpanelinner">

      <!-- ################## LEFT PANEL PROFILE ################## -->

    <div class="media leftpanel-profile">
        <div class="media-left">
            <a href="#">
                <img src="<?=Yii::$app->user->identity->avatar ?>" alt="" class="media-object img-circle">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading"><?=Yii::$app->user->identity->username?><a data-toggle="collapse" data-target="#loguserinfo" class="pull-right"><i class="fa fa-angle-down"></i></a></h4>
            <span>管理员</span>
        </div>
    </div><!-- leftpanel-profile -->

    <div class="leftpanel-userinfo collapse" id="loguserinfo">
        <h5 class="sidebar-title">地址</h5>
        <address><?= Yii::$app->user->identity->address?></address>
        <h5 class="sidebar-title">联系方式</h5>
        <ul class="list-group">
            <li class="list-group-item">
                <label class="pull-left">邮箱</label>
                <span class="pull-right"><?= Yii::$app->user->identity->email ?></span>
            </li>
            <li class="list-group-item">
                <label class="pull-left">电话</label>
                <span class="pull-right"><?= Yii::$app->user->identity->contact ?></span>
            </li>
            <li class="list-group-item">
                <label class="pull-left">手机</label>
                <span class="pull-right"><?= Yii::$app->user->identity->mobilePhone ?></span>
            </li>
            <li class="list-group-item">
                <label class="pull-left">所属区域</label>
                <span class="pull-right"><?= Yii::$app->user->identity->areaName ?></span>
            </li>
            <li class="list-group-item">
                <label class="pull-left">第三方</label>
                <div class="social-icons pull-right">
                    <a href="#"><i class="fa fa-facebook-official"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                </div>
            </li>
        </ul>
        <div class="sidebar-title" id="time"></div>
    </div><!-- leftpanel-userinfo -->
    <div class="tab-content">
    
        <div class="tab-pane active" id="mainmenu">
            <h5 class="sidebar-title">菜单</h5>
            <!-- sidebar组件 -->
            <?=SidebarWidget::widget([
                'encodeLabels' => false,
            ])?>
        </div>
    </div><!-- tab-content -->

    </div><!-- leftpanelinner -->
</div><!-- leftpanel -->

  <div class="mainpanel">
    <div class="contentpanel">
        <?= Breadcrumbs::widget([
            'homeLink'=>[
                'label' => '<i class="fa fa-home mr5"></i> '.Yii::t('yii', 'Home'),
                'url' => '/',
                'encode' => false,
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'tag'=>'ol',
            'options' => ['class' => 'breadcrumb breadcrumb-quirk']
        ]) ?>                
        <hr class="darken"> 
        <?= Alert::widget() ?>       
        <?=$content?>
    </div>
    
  </div><!-- mainpanel -->


</section>

<?php Modal::begin([    
    'id' => 'create-modal',    
    'header' => '<h4 class="modal-title"></h4>',    
]); 
Modal::end();
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
