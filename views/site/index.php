<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = $settings->applicationName . ' - Dashboard';
//$this->registerCssFile(Yii::$app->request->baseUrl . '/css/xenon-components.css');
//$this->registerCssFile(Yii::$app->request->baseUrl . '/css/fonts/linecons/css/linecons.css');
$this->registerCssFile('//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css');
////code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css
//echo \Yii::$app->session->get('branch');
//echo 'branchId :'.Yii::$app->user->identity->branchId;
//echo 'role :'.Yii::$app->user->identity->role;
$this->registerJsFile('https://apis.google.com/js/platform.js', ['jsOptions' => ['asynch', 'defer'], 'depends' => [app\assets\AppAsset::className()]]);
?>
<p>&nbsp;</p>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                   2
                </h3>
                <p>
                    Order
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a class="small-box-footer" href="<?php echo Url::to(['order/create']); ?>">
                Go to Order <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-light-blue-gradient">
            <div class="inner">
                <h3>
                    3
                </h3>
                <p>
                    Stock
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a class="small-box-footer" href="<?php echo Url::to(['/stock']); ?>">
                Go to Stock <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    Reports
                </h3>
                <p>
                    Graphic
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a class="small-box-footer" href="<?php echo Url::to(['report/index']); ?>">
                Go to Graphic <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
</div>
<hr>
<div class="row">
    <!-- Left col -->
    <section class="col-lg-9 connectedSortable ui-sortable">

        <!-- Chat box -->
        <?php
        echo \sintret\chat\ChatRoom::widget([
            'url' => \yii\helpers\Url::to(['/ajax/send-chat']),
            'userModel' => \app\models\User::className(),
            'userField' => 'avatarImage'
        ]);
        ?>
        <!-- To Do List -->
        <?php
        echo \sintret\todolist\ListView::widget([
            'url' => \yii\helpers\Url::to(['/ajax/todolist']),
            'relations' => app\models\User::className(),
        ]);
        ?>

    </section><!-- /.Left col -->
    <div class="col-md-3">
        <?php
        $phone = [];
        $users = app\models\User::find()->where(['status' => app\models\User::STATUS_ACTIVE])->all();
        if ($users)
            foreach ($users as $user) {
                if ($user->phone)
                    $invite[] = "{ id : '$user->phone', invite_type : 'PHONE' }";
                $invite[] = "{ id : '$user->email', invite_type : 'EMAIL' }";
            }
        $invites = implode(",", $invite);
        //echo $invites;
        ?>


        <div class="col-md-12">
            <div class="box box-solid">
                
       <img src="http://sintret.com/qrcode?text=http://gurame.net/kueijo/apk/fins.apk&label=Scan for Android App&size=200&font-size=9" />

            </div><!-- /.box -->
            <!-- Info Boxes Style 2 -->
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Video Call</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="g-hangout" data-invites="[<?= $invites; ?>]" data-render="createhangout" data-topic="Adiadrian Salon" data-hangout_type="normal"  data-widget_size="175"></div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

          

        </div>
    </div><!-- /.end col-md-3 -->

</div>